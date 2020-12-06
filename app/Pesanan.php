<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $fillable = [
        'id_keranjang', 'id_product', 'total_harga'
    ];

    public function product()
    {
        return $this->belongsTo('App\Product','id_product','id');
    }

    public function pesanan()
    {
        return $this->belongsTo('App\Pesanan','id_pesanan','id');
    }
}
