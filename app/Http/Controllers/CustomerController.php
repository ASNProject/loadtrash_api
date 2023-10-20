<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function store(Request $request){
        $validasi = Validator::make($request->all(),[
            'id_user' => 'required',
            'name' => 'required',
            'password' => 'required',
            'address' => 'nullable',
            'id_number' => 'required',
            'id_status' => 'nullable',
            'id_load' => 'nullable',
        ]);

        if($validasi->fails()){
            return response()->json($validasi->errors());
        } else {
            $post = new Customer;
            $post->id_user = $request->id_user;
            $post->name = $request->name;
            $post->password = $request->password;
            $post->address = $request->address;
            $post->id_number = $request->id_number;
            $post->registration = $request->registration;
            $post->id_status = $request->id_status;
            $post->id_load = $request->id_load;

            if($post->save()){
                return response()->json('Customer berhasil disimpan');
            } else {
                return response()->json('Customer gagal ditambahkan');
            }
        }
    }

    public function index(){
        $posts = Customer::all();
        return response([
            $posts
        ]);
    }

    public function detail($id_user){
        $post = Customer::where('id_user', $id_user)->first();
        if ($post){
            return response()->json($post);
        } else {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
    }
}
