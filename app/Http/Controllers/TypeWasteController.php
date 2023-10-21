<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TypeWaste;
use Illuminate\Support\Facades\Validator;

class TypeWasteController extends Controller
{
    public function store(Request $request){
        $validasi = Validator::make($request->all(),[
            'id_type' => 'required',
            'type' => 'nullable',
            'price' => 'nullable',
        ]);

        if($validasi->fails()){
            return response()->json($validasi->errors());
        } else {
            $post = new TypeWaste;
            $post->id_type = $request->id_type;
            $post->type = $request->type;
            $post->price = $request->price;

            if($post->save()){
                return response()->json('TypeWaste berhasil disimpan');
            } else {
                return response()->json('TypeWaste gagal ditambahkan');
            }
        }
    }

    public function index(){
        $posts = TypeWaste::all();
        return response([
            $posts
        ]);
    }

    public function detail($id_type){
        $post = TypeWaste::where('id_type', $id_type)->first();
        if ($post){
            return response()->json($post);
        } else {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
    }
}
