<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Warga;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getAllResident()
    {
        $data = Warga::paginate(20);
        $data->getCollection()->transform(function ($warga) {
            $warga['umur'] = Carbon::parse($warga->tanggal_lahir)->age;
            return $warga;
        });
        if (!$data) {
            return response()->json([
                'succes' => false,
                'message' => 'Data residen Kosong'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => 'Daftar semua warga',
            'data' => $data,
        ]);
    }

    public function delete($id)
    {
        $data = Warga::find($id);
        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => "Data tidak dapat ditemukan",
            ]);
        }

        $delete = $data->delete();
        if (!$delete) {
            return response()->json([
                'success' => false,
                'message' => 'Data Gagal dihapus'
            ]);
        }

        return response()->json([
            'succuss' => true,
            'message' => 'Data Berasil Dihapus'
        ]);
    }
}
