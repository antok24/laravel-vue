<?php

namespace App\Http\Controllers;

use App\Keranjang;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KeranjangController extends Controller
{
    public function index()
    {
        $keranjangs = Keranjang::latest()->get();

        return response([
            'success' => true,
            'message' => 'Dafta keranjang',
            'data' => $keranjangs
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jumlah_pesan' => 'required',
        ],
            [
                'jumlah_pesan.required' => 'Harus diisi !',
            ]
        );

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Silahkan isi Bidang yang masih kosong',
                'data' => $validator->errors()
            ], 400);
        }else{
            $keranjangs = Keranjang::create([
                'jumlah_pesan' => $request->input('jumlah_pesan'),
                'keterangan' => $request->input('keterangan'),
                'id_product' => $request->input('id_product'),
            ]);

            if($keranjangs) {
                return response()->json([
                    'success' => true,
                    'message' => 'Product berhasil dimasukkan ke keranjang',
                ], 200);
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Product gagal dimasukkan keranjang',
                ], 400);
            }
        }
    }
}
