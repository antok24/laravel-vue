<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'kode', 'nama', 'harga', 'is_ready'
    ];

    public function keranjang()
    {
        return $this->hasMany('App\Keranjang','id_product','id');
    }
}
