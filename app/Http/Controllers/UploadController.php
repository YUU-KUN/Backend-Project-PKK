<?php
 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Gambar;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
 
class UploadController extends Controller
{   

    public function index()
    {
        $data["count"] = Gambar::count();
        $gambar = array();
        foreach (Gambar::all() as $p) {
            $item = [
                "id"          => $p->id,
                // "file"        => $p->file,
                "nama_produk"        => $p->nama_produk,
                "stock"       => $p->stock,
                "jenis"       => $p->jenis,
                "harga"       => $p->harga,                
                "takaran"     => $p->takaran,                
                "dibeli"      => $p->dibeli,
                "created_at"  => $p->created_at,
                "updated_at"  => $p->updated_at
            ];
            array_push($gambar, $item);
        }
        $data['jumlah barang yang tersedia'] = Gambar::sum('stock');
        $data['jumlah barang yang dibeli'] = Gambar::sum('dibeli');
        $data["rincian"] = $gambar;
        return response($data);
    }

    public function getAll($limit = 10, $offset = 0){
        $data["count"] = Gambar::count();
        $gambar = array();

        foreach (Gambar::take($limit)->skip($offset)->get() as $p) {
            $item = [
                "id"          => $p->id,
                // "name"        => $p->name,
                "nama_produk"        => $p->nama_produk,
                "stock"        => $p->stock,
                "jenis"    	  => $p->jenis,
                "harga"    => $p->harga,
                "takaran"    => $p->takaran,
                "dibeli"    => $p->dibeli,
                "created_at"  => $p->created_at,
                "updated_at"  => $p->updated_at
            ];

            array_push($gambar, $item);
        }
        $data["gambar"] = $gambar;
        $data["status"] = 1;
        return response($data);
    }

    public function find(Request $request, $limit = 10, $offset = 0)
    {
        $find = $request->find;
        $gambar = Gambar::where("id","like","%$find%")
        ->orWhere("nama_produk","like","%$find%");
        // ->orWhere("name","like","%$find%")
        // ->orWhere("email","like","%$find%");
        $data["count"] = $gambar->count();
        $gambar = array();
        foreach ($gambar->skip($offset)->take($limit)->get() as $p) {
          $item = [
            "id"          => $p->id,
                // "file"        => $p->file,
                "nama_produk"        => $p->nama_produk,
                "stock"       => $p->stock,
                "jenis"       => $p->jenis,
                "harga"       => $p->harga,                
                "takaran"     => $p->takaran,                
                "dibeli"      => $p->dibeli,
                "created_at"  => $p->created_at,
                "updated_at"  => $p->updated_at
          ];
          array_push($gambar,$item);
        }
        $data["gambar"] = $gambar;
        $data["status"] = 1;
        return response($data);
    }

    public function store(Request $request)
    {
        $gambar = new Gambar([
            // 'file'      => $request->file,
            'nama_produk'     => $request->nama_produk,
            'stock'     => $request->stock,
            'jenis'     => $request->jenis,
			'harga'     => $request->harga,
            'takaran'   => $request->takaran,  
            'dibeli'    => 0,
        ]);
		// menyimpan data file yang diupload ke variabel $file
		// $file = $request->file('file');
		// $nama_file = time()."_".$file->getClientOriginalName();
        // isi dengan nama folder tempat kemana file diupload
		// $tujuan_upload = 'data_file';
        // $file->move($tujuan_upload,$nama_file);
        $gambar->save();
        // return response($gambar);
        return response()->json([
          'message'	=> 'Tambah Produk Berhasil',
          "gambar"    => $gambar,
        ], 201);
    }


    public function update($id, Request $request)
    {
        $gambar = Gambar::where('id', $id)->first();
        // $gambar->file       = $request->file;
        $gambar->nama_produk       = $request->nama_produk;
        $gambar->stock      = $request->stock;
        $gambar->jenis      = $request->jenis;
        $gambar->harga      = $request->harga;
        $gambar->takaran    = $request->takaran;
        $gambar->dibeli     = 0;
        $gambar->updated_at = now()->timestamp;
        $gambar->save();
        return response()->json([
          'message'	=> 'Edit Produk Berhasil',
          "gambar"  => $gambar,
        ], 201); 
    }


    public function destroy($id)
    {
        $gambar = Gambar::where('id', $id)->first();
        $gambar->delete();
        return response()->json([
            "status"	=> 1,
            'message' => 'Delete Produk Berhasil'
        ]);
    }    
}