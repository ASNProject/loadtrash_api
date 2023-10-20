<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Credit;
use Illuminate\Support\Facades\Validator;


class CreditController extends Controller
{
    public function store(Request $request){
        $validasi = Validator::make($request->all(),[
            'id_user' => 'required',
            'id_type' => 'nullable',
            'weight' => 'nullable',
            'credit' => 'nullable',
            'date_credit' => 'nullable',
        ]);

        if($validasi->fails()){
            return response()->json($validasi->errors());
        } else {
            $post = new Credit;
            $post->id_user = $request->id_user;
            $post->id_type = $request->id_type;
            $post->weight = $request->wight;
            $post->credit = $request->credit;
            $post->date_credit = $request->date_credit;

            if($post->save()){
                return response()->json('Credit berhasil disimpan');
            } else {
                return response()->json('Credit gagal ditambahkan');
            }
        }
    }

    public function index(){
        $posts = Credit::all();
        return response([
            $posts
        ]);
    }

    public function detail($id_user){
        $post = Credit::where('id_user', $id_user)->first();
        if ($post){
            return response()->json($post);
        } else {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
    }
}
