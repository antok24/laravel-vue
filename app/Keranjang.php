<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    protected $fillable = [
        'jumlah_pesan', 'keterangan', 'id_product','status_pesanan'
    ];

    public function product()
    {
        return $this->belongsTo('App\Product','id_product','id');
    }
}
