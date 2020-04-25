<?php

namespace App\Http\Controllers;
use App\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(Request $request)
    {
        $cart = new Cart([
            // 'file'      => $request->file,
            // 'id'     => $request->id,
            'nama_produk'     => $request->nama_produk,
            'stock'     => $request->stock,
            'jenis'     => $request->jenis,
			'harga'     => $request->harga,
            'takaran'   => $request->takaran,  
        ]);		
        $cart->save();
        return response()->json([
            "status"	=> 1,
          'message'	=> 'Berhasil menambahkan ke Cart',
          "cart"    => $cart,
        ], 201);
    }

    public function index()
    {
        $data["count"] = Cart::count();
        $cart = array();
        foreach (Cart::all() as $p) {
            $item = [
                "id"          => $p->id,
                // "file"        => $p->file,
                "nama_produk"        => $p->nama_produk,
                "stock"       => $p->stock,
                "jenis"       => $p->jenis,
                "harga"       => $p->harga,                
                "takaran"     => $p->takaran,                
                // "dibeli"      => $p->dibeli,
                "created_at"  => $p->created_at,
                "updated_at"  => $p->updated_at
            ];
            array_push($cart, $item);
        }
        // $data['jumlah barang yang tersedia'] = Gambar::sum('stock');
        // $data['jumlah barang yang dibeli'] = Gambar::sum('dibeli');
        // $data["rincian"] = $gambar;
        return response($data);
    }

    public function getAll($limit = 10, $offset = 0){
        $data["count"] = Cart::count();
        $cart = array();

        foreach (Cart::take($limit)->skip($offset)->get() as $p) {
            $item = [
                "id"          => $p->id,
                // "name"        => $p->name,
                "nama_produk"        => $p->nama_produk,
                "stock"        => $p->stock,
                "jenis"    	  => $p->jenis,
                "harga"    => $p->harga,
                "takaran"    => $p->takaran,
                // "dibeli"    => $p->dibeli,
                "created_at"  => $p->created_at,
                "updated_at"  => $p->updated_at
            ];

            array_push($cart, $item);
        }
        $data["cart"] = $cart;
        $data["status"] = 1;
        return response($data);
    }

    public function find(Request $request, $limit = 10, $offset = 0)
    {
        $find = $request->find;
        $cart = Cart::where("id","like","%$find%")
        ->orWhere("nama_produk","like","%$find%");
        // ->orWhere("name","like","%$find%")
        // ->orWhere("email","like","%$find%");
        $data["count"] = $cart->count();
        $cart = array();
        foreach ($cart->skip($offset)->take($limit)->get() as $p) {
          $item = [
            "id"          => $p->id,
                // "file"        => $p->file,
                "nama_produk"        => $p->nama_produk,
                "stock"       => $p->stock,
                "jenis"       => $p->jenis,
                "harga"       => $p->harga,                
                "takaran"     => $p->takaran,                
                // "dibeli"      => $p->dibeli,
                "created_at"  => $p->created_at,
                "updated_at"  => $p->updated_at
          ];
          array_push($cart,$item);
        }
        $data["cart"] = $cart;
        $data["status"] = 1;
        return response($data);
    }

    public function update($id, Request $request)
    {
        $cart = Cart::where('id', $id)->first();
        // $gambar->file       = $request->file;
        $cart->nama_produk       = $request->nama_produk;
        $cart->stock      = $request->stock;
        $cart->jenis      = $request->jenis;
        $cart->harga      = $request->harga;
        $gacartmbar->takaran    = $request->takaran;
        $cart->dibeli     = 0;
        $cart->updated_at = now()->timestamp;
        $cart->save();
        return response()->json([
          'message'	=> 'Edit Produk Berhasil',
          "cart"  => $cart,
        ], 201); 
    }


    public function destroy($id)
    {
        $cart = Cart::where('id', $id)->first();
        $cart->delete();
        return response()->json([
            "status"	=> 1,
            'message' => 'Delete Produk Berhasil'
        ]);
    }    
}
