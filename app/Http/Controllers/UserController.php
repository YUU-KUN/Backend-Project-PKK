<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    
	//fungsi untuk login
	public function login(Request $request){
		$credentials = $request->only('email', 'password');

		try {
			if(!$token = JWTAuth::attempt($credentials)){
				return response()->json([
						'logged' 	=>  false,
						'message' 	=> 'Invalid email and password'
					]);
			}
		} catch(JWTException $e){
			return response()->json([
						'logged' 	=> false,
						'message' 	=> 'Generate Token Failed'
					]);
		}

		return response()->json([
					"logged"    => true,
                    "token"     => $token,
                    "message" 	=> 'Login berhasil'
		]);
	}

	public function getAll($limit = 10, $offset = 0){
        $data["count"] = User::count();
        $user = array();

        foreach (User::take($limit)->skip($offset)->get() as $p) {
            $item = [
                "id"          => $p->id,
                // "name"        => $p->name,
                "firstname"        => $p->firstname,
                "lastname"        => $p->lastname,
                "email"    	  => $p->email,
                "password"    => $p->password,
                "created_at"  => $p->created_at,
                "updated_at"  => $p->updated_at
            ];

            array_push($user, $item);
        }
        $data["user"] = $user;
        $data["status"] = 1;
        return response($data);
    }

    public function find(Request $request, $limit = 10, $offset = 0)
    {
        $find = $request->find;
        $user = User::where("id","like","%$find%")
        ->orWhere("fistname","like","%$find%")
        // ->orWhere("name","like","%$find%")
        ->orWhere("email","like","%$find%");
        $data["count"] = $user->count();
        $users = array();
        foreach ($user->skip($offset)->take($limit)->get() as $p) {
          $item = [
            "id" => $p->id,
            "firstname" => $p->firstname,
            // "name" => $p->name,
            "email" => $p->email,
            "password" => $p->password,
            "created_at" => $p->created_at,
            "updated_at" => $p->updated_at
          ];
          array_push($users,$item);
        }
        $data["user"] = $users;
        $data["status"] = 1;
        return response($data);
    }

    public function delete($id)
    {
        try{

            User::where("id", $id)->delete();

            return response([
            	"status"	=> 1,
                "message"   => "Data berhasil dihapus."
            ]);
        } catch(\Exception $e){
            return response([
            	"status"	=> 0,
                "message"   => $e->getMessage()
            ]);
        }
    }

	public function register(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'firstname'         => 'required|string|max:255',
			'lastname'          => 'required|string|max:255',
			'email'             => 'required|string|email|max:100|unique:user',
			'kategori' 			=> 'required|in:penjual,pembeli',				
			'password'          => 'required_with:password_verify|same:password_verify|string|min:6',
			'password_verify'   => 'string|min:6',
		]);
			if ($validator->fails()) {
				return response()->json($validator->errors()->toJson());
			}
			$user = new User();
			$user->firstname        = $request->firstname;
			$user->lastname         = $request->lastname;
			$user->email 	        = $request->email;
			$user->kategori         = $request->kategori;
			$user->password         = Hash::make($request->password);
			$user->password_verify  = Hash::make($request->password_verify);
			$user->save();
	
			$token = JWTAuth::fromUser($user);
	
			// return response($user); -> untuk menampilkan data registrasi
			return response()->json([
				'message'	=> 'User berhasil teregistrasi', //menampilkan pesan registrasi
				"auth"      => true,
				"user"    	=> $user,
			], 201);   
	}

	public function ubah(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'name' => 'required|string|max:255',
			'email' => 'required|string|email|max:255',
			'password' => 'required|string|min:6',
		]);

		if($validator->fails()){
			return response()->json([
				'status'	=> '0',
				'message'	=> $validator->errors()
			]);
		}

		//proses update data
		$user = User::where('id', $request->id)->first();
		$user->name 	= $request->name;
		$user->email 	= $request->email;
		$user->password = Hash::make($request->password);
		$user->save();


		return response()->json([
			'status'	=> '1',
			'message'	=> 'User berhasil diubah'
		], 201);
	}

	public function getAuthenticatedUser(){
		try {
			if(!$user = JWTAuth::parseToken()->authenticate()){
				return response()->json([
						'auth' 		=> false,
						'message'	=> 'Invalid token'
					]);
			}
		} catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e){
			return response()->json([
						'auth' 		=> false,
						'message'	=> 'Token expired'
					], $e->getStatusCode());
		} catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e){
			return response()->json([
						'auth' 		=> false,
						'message'	=> 'Invalid token'
					], $e->getStatusCode());
		} catch (Tymon\JWTAuth\Exceptions\JWTException $e){
			return response()->json([
						'auth' 		=> false,
						'message'	=> 'Token absent'
					], $e->getStatusCode());
		}

		 return response()->json([
		 		"auth"      => true,
                "user"    => $user
		 ], 201);
	}

	// logout
	public function logout(Request $request)
    {

        if(JWTAuth::invalidate(JWTAuth::getToken())) {
            return response()->json([
                "logged"    => false,
                "message"   => 'Logout berhasil'
            ], 201);
        } else {
            return response()->json([
                "logged"    => true,
                "message"   => 'Logout gagal'
            ], 201);
        }
    }

}
