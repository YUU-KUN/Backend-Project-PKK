<?php
 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Gambar extends Model
{
    protected $table = "gambar";
 
    protected $fillable = [
        // 'file', 
        'nama_produk', 'stock','jenis','harga','takaran','dibeli',];

    public function transaksi(){
        return $this->hasMany('App\Transaksi', 'idgambar', 'id');
        }
}