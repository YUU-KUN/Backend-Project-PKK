<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = "cart";
 
    protected $fillable = [
        // 'file', 
        'nama_produk', 'stock','jenis','harga','takaran',];
}
