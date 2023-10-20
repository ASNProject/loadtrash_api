<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Debit;
use Illuminate\Support\Facades\Validator;

class DebitController extends Controller
{
    public function store(Request $request){
        $validasi = Validator::make($request->all(),[
            'id_user' => 'required',
            'debit' => 'nullable',
            'status_withdrawal' => 'nullable',
            'date_withdrawal' => 'nullable',
        ]);

        if($validasi->fails()){
            return response()->json($validasi->errors());
        } else {
            $post = new Debit;
            $post->id_user = $request->id_user;
            $post->debit = $request->debit;
            $post->status_withdrawal = $request->status_withdrawal;
            $post->date_withdrawal = $request->date_withdrawal;

            if($post->save()){
                return response()->json('Debit berhasil disimpan');
            } else {
                return response()->json('Debit gagal ditambahkan');
            }
        }
    }

    public function index(){
        $posts = Debit::all();
        return response([
            $posts
        ]);
    }

    public function detail($id_user){
        $post = Debit::where('id_user', $id_user)->first();
        if ($post){
            return response()->json($post);
        } else {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
    }
}
