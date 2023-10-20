<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Load;
use Illuminate\Support\Facades\Validator;

class LoadController extends Controller
{
    public function store(Request $request){
        $validasi = Validator::make($request->all(),[
            'code' => 'required',
            'password' => 'nullable',
            'value' => 'nullable',
        ]);

        if($validasi->fails()){
            return response()->json($validasi->errors());
        } else {
            $post = new Load;
            $post->code = $request->code;
            $post->password = $request->password;
            $post->value = $request->value;

            if($post->save()){
                return response()->json('Load berhasil disimpan');
            } else {
                return response()->json('Load gagal ditambahkan');
            }
        }
    }

    public function index(){
        $posts = Load::all();
        return response([
            $posts
        ]);
    }

    public function detail($code){
        $post = Load::where('code', $code)->first();
        if ($post){
            return response()->json($post);
        } else {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
    }
}
