<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = "transaksi";

    protected $fillable = ['iduser','idgambar','firstname','lastname','jumlah_beli','tanggal_transaksi',];

    public function gambar(){
    	return $this->belongsTo('App\Gambar', 'idgambar', 'id');
    }
}
