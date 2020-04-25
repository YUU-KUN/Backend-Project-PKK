<?php

namespace App\Http\Controllers;
use App\Transaksi;
use App\Gambar;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{

    public function index($limit = 10, $offset = 0)
    {
        $data["count"] = Transaksi::count();
        $transaksi = array();
        foreach (Transaksi::take($limit)->skip($offset)->get() as $p) {
            $item = [
                "id"                => $p->id,
                "iduser"            => $p->iduser,
                "idgambar"          => $p->idgambar,
                "firstname"        => $p->firstname,
                "lastname"         => $p->lastname,
                "jumlah_beli"       => $p->jumlah_beli,
                "tanggal_transaksi" => $p->tanggal_transaksi,
                "created_at"        => $p->created_at,
                "updated_at"        => $p->updated_at,
            ];
            
            array_push($transaksi, $item);
        }
        $data["transaksi"] = $transaksi;
        $data["status"] = 1;
        return response($data);
    }

    public function pesan(Request $request)
    {
        $userid                    = $request->user; 
        $user                      = User::where('id', $userid)->first();
        $gambar                    = Gambar::where('id', $request->id)->first();
        $terbeli                   = $gambar->stock - $request->jumlah_beli;
        $gambar->dibeli            = $gambar->dibeli + $request->jumlah_beli;
        if($gambar->stock > $request->jumlah_beli ){ 
            $gambar->stock = $gambar->stock - $request->jumlah_beli;
            $gambar->save();
            
            $transaksi = new Transaksi();
            $transaksi->iduser	            = $request->iduser;
            $transaksi->idgambar      	    = $request->idgambar;
            $transaksi->firstname 	        = $request->firstname;
            $transaksi->lastname 	        = $request->lastname;
            $transaksi->jumlah_beli         = $request->jumlah_beli;
            $transaksi->tanggal_transaksi   = date("y/m/d");
            $transaksi->save();
            
            return response()->json([
                'status'	=> '1',
                'message'	=> 'Barang berhasil dibeli'
            ], 201);
        }
        else{
            return response()->json([
                'status'	=> '0',
                'message'	=> 'Stock habis'
            ], 201);
        }
    }

    public function update($id, Request $request)
    {
        $transaksi = Transaksi::where('id', $id)->first();
        $transaksi->iduser	            = $request->iduser;
        $transaksi->idgambar      	    = $request->idgambar;
        $transaksi->firstname 	        = $request->firstname;
        $transaksi->lastname 	        = $request->lastname;
        $transaksi->jumlah_beli         = $request->jumlah_beli;
        $transaksi->tanggal_transaksi   = date("y/m/d");
        $transaksi->save();
        return response()->json([
          'message'	=> 'Edit Transaksi Berhasil',
          "transaksi"  => $transaksi,
        ], 201); 
    }


    public function destroy($id)
    {
        $transaksi = Transaksi::where('id', $id)->first();
        $transaksi->delete();
        return response()->json([
          'message' => 'Delete Transaksi Berhasil'
        ]);
    }    

    public function show($id)
    {
        $transaksi = Transaksi::where('id', $id)->get();
        $transaksi_beli = array();
        foreach ($transaksi as $p) {
            $item = [
                "id"                => $p->id,
                "iduser"            => $p->iduser,
                "idgambar"          => $p->idgambar,
                "firstname"        => $p->firstname,
                "lastname"         => $p->lastname,
                "jumlah_beli"       => $p->jumlah_beli,
                "tanggal_transaksi" => $p->tanggal_transaksi,
                "created_at"        => $p->created_at,
                "updated_at"        => $p->updated_at,
            ];
            array_push($transaksi_beli, $item);
        }
        $data["transaksi_beli"] = $transaksi_beli;
        return response($data);
    }

    public function detail($id)
    {
        $transaksi = Transaksi::where('iduser', $id)->get();
        $transaksi_beli = array();
        foreach ($transaksi as $p) {
            $item = [
                "id"                => $p->id,
                "iduser"            => $p->iduser,
                "idgambar"          => $p->idgambar,                
                "jenis"             => $p->gambar->jenis,
                "harga"             => $p->gambar->harga,
                "takaran"           => $p->gambar->takaran,
                "jumlah_beli"       => $p->jumlah_beli,
                "tanggal_transaksi" => $p->tanggal_transaksi,
                "created_at"        => $p->created_at,
                "updated_at"        => $p->updated_at,
            ];
            array_push($traksaksi_beli, $item);
        }
        $data["transaksi_beli"] = $transaksi_beli;
        return response($data);
    }
}
