<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Status;
use Illuminate\Support\Facades\Validator;

class StatusController extends Controller
{
    public function store(Request $request){
        $validasi = Validator::make($request->all(),[
            'id_status' => 'required',
            'status' => 'nullable',
        ]);

        if($validasi->fails()){
            return response()->json($validasi->errors());
        } else {
            $post = new Status;
            $post->id_user = $request->id_user;
            $post->id_type = $request->id_type;
            $post->weight = $request->wight;
            $post->credit = $request->credit;
            $post->date_credit = $request->date_credit;

            if($post->save()){
                return response()->json('Status berhasil disimpan');
            } else {
                return response()->json('Status gagal ditambahkan');
            }
        }
    }

    public function index(){
        $posts = Status::all();
        return response([
            $posts
        ]);
    }

    public function detail($id_status){
        $post = Status::where('id_status', $id_status)->first();
        if ($post){
            return response()->json($post);
        } else {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
    }
}
