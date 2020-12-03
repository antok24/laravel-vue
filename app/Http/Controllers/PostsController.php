<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();

        return response([
            'success' => true,
            'message' => 'List Semua Post',
            'data' => $posts
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
        ],
            [
                'title.required' => 'Title Post Harus diisi !',
                'content.required' => 'Content Post Harus diisi !',
            ]
        );

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Silahkan isi Bidang yang masih kosong',
                'data' => $validator->errors()
            ], 400);
        }else{
            $post = Post::create([
                'title' => $request->input('title'),
                'content' => $request->input('content'),
            ]);

            if($post) {
                return response()->json([
                    'success' => true,
                    'message' => 'Postingan berhasil disimpan',
                ], 200);
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Postingan gagal disimpan',
                ], 400);
            }
        }
    }

    public function show($id)
    {
        $post = Post::whereId($id)->first();

        if($post) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Post',
                'data' => $post
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Post tidak ditemukan',
                'data' => ''
            ], 400);
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
        ],
            [
                'title.required' => 'Title Post Harus diisi !',
                'content.required' => 'Content Post Harus diisi !',
            ]
        );

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Silahkan isi Bidang yang masih kosong',
                'data' => $validator->errors()
            ], 400);
        }else{
            $post = Post::whereId($request->input('id'))->update([
                'title' => $request->input('title'),
                'content' => $request->input('content'),
            ]);

            if($post) {
                return response()->json([
                    'success' => true,
                    'message' => 'Post berhasil diupdate',
                ], 200);
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Post gagal diupdate',
                ], 500);
            }
        }
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        if($post) {
            return response()->json([
                'success' => true,
                'message' => 'Post berhasil dihapus',
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Post gagal dihapus',
            ], 500);
        }
    }
}
