<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Status;
use Illuminate\Support\Facades\Validator;

class StatusController extends Controller
{
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'id_status' => 'required',
            'status' => 'nullable',
        ]);

        if ($validasi->fails()) {
            return response()->json($validasi->errors());
        } else {
            $status = new Status;
            $status->id_status = $request->id_status;
            $status->status = $request->status;

            if ($status->save()) {
                return response()->json('Status berhasil disimpan');
            } else {
                return response()->json('Status gagal ditambahkan');
            }
        }
    }

    public function index()
    {
        $statuses = Status::all();

        $data = [
            'message' => 'Get method status',
            'data' => []
        ];

        foreach ($statuses as $status) {
            $data['data'][] = [
                'id_status' => $status->id_status,
                'status' => $status->status
            ];
        }

        return response()->json($data);
    }

    public function detail($id_status)
    {
        $status = Status::where('id_status', $id_status)->first();

        if ($status) {
            $data = [
                'message' => 'Get method status',
                'data' => [
                    [
                        'id_status' => $status->id_status,
                        'status' => $status->status
                    ]
                ]
            ];

            return response()->json($data);
        } else {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
    }
}
