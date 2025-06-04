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


    public function search(Request $request)
    {
        $keyword = $request->input('q');
        $data = Warga::with('kk')
            ->where('nik', 'like', "%$keyword%")
            ->orWhere('nama', 'like', "%$keyword%")
            ->orWhereHas('kk', function ($q) use ($keyword) {
                $q->where('no_kk', 'like', "%$keyword%");
            })->paginate(10);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Hasil tidak ditemukan',
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Hasil pencarian',
            'data' => $data
        ]);
    }

    public function see($id)
    {
        $data = Warga::with(
            [
                'kendaraan',
                'kepemilikan_tanah',
                'kepemilikan_elektronik',
                'kepemilikan_ternak',
                'kk',
                'penggunaan_air',
                'penggunaan_bahan_bakar',
                'usaha',
                'wc_kamar_mandi'
            ]
        )->where('id', $id)->first();

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => "Gagal Menemukan Data Dengan Id $id",
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => "Berhasil mengambil data dengan Id $id",
            'data' => $data
        ]);
    }
}
