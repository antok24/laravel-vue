<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();

        return response([
            'success' => true,
            'message' => 'List Semua Product',
            'data' => $products
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode' => 'required',
            'nama' => 'required',
            'harga' => 'required',
        ],
            [
                'kode.required' => 'Fild Harus diisi !',
                'nama.required' => 'Fild Harus diisi !',
                'harga.required' => 'Fild Harus diisi !',
            ]
        );

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Silahkan isi Bidang yang masih kosong',
                'data' => $validator->errors()
            ], 400);
        }else{
            $product = Product::create([
                'kode' => $request->input('kode'),
                'nama' => $request->input('nama'),
                'harga' => $request->input('harga'),
            ]);

            if($product) {
                return response()->json([
                    'success' => true,
                    'message' => 'Product berhasil disimpan',
                ], 200);
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Product gagal disimpan',
                ], 400);
            }
        }
    }

    public function show($id)
    {
        $product = Product::whereId($id)->first();

        if($product) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Product',
                'data' => $product
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Product tidak ditemukan',
                'data' => ''
            ], 400);
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'harga' => 'required',
        ],
            [
                'nama.required' => 'Fild Harus diisi !',
                'harga.required' => 'Fild Harus diisi !',
            ]
        );

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Silahkan isi Bidang yang masih kosong',
                'data' => $validator->errors()
            ], 400);
        }else{
            $product = Product::whereId($request->input('id'))->update([
                'nama' => $request->input('nama'),
                'harga' => $request->input('harga'),
            ]);

            if($product) {
                return response()->json([
                    'success' => true,
                    'message' => 'Product berhasil disimpan',
                ], 200);
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Product gagal disimpan',
                ], 400);
            }
        }
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        if($product) {
            return response()->json([
                'success' => true,
                'message' => 'Product berhasil dihapus',
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Product gagal dihapus',
            ], 500);
        }
    }
}
