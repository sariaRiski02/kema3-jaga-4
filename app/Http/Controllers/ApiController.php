<?php

namespace App\Http\Controllers;

use App\Models\Kk;
use Carbon\Carbon;
use App\Models\Warga;
// use Illuminate\Container\Attributes\Log;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function getAllResident()
    {
        $data = Warga::latest()->paginate(20);
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
                'kk',
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


    public function search_kk(Request $request)
    {
        $term = $request->input('term');
        $kk = Kk::where('no_kk', 'like', "%$term%")
            ->limit(10)
            ->pluck('no_kk');

        return response()->json([
            'status' => true,
            'messege' => "Success to Get data",
            'data' => $kk,
        ]);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:20|unique:warga,nik',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'tanggal_kematian' => 'nullable|date|after:tanggal_lahir',
            'alamat' => 'nullable|string|max:255',
            'status_keluarga' => 'required|string|max:50',
            'pekerjaan' => 'nullable|string|max:100',
            'agama' => 'required|string|max:50',
            'status_perkawinan' => 'required|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
            'pendidikan' => 'required|string|max:100|in:Tidak Sekolah,PAUD,TK,SD/Sederajat,SMP/Sederajat,SMA/Sederajat,Diploma,Sarjana,Pascasarjana,Lainnya',
            'no_kk' => 'required|string',




        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $kk = kk::where('no_kk', $request->no_kk)->first();

        if (!$kk) {
            $kk = new Kk;
            $kk->no_kk = $request->no_kk;
            $kk->save();
        }

        $warga = Warga::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'tanggal_kematian' => $request->tanggal_kematian,
            'pendidikan' => $request->pendidikan,
            'alamat' => $request->alamat,
            'status_keluarga' => $request->status_keluarga,
            'pekerjaan' => $request->pekerjaan,
            'agama' => $request->agama,
            'status_perkawinan' => $request->status_perkawinan,
            'kk_id' => $kk->id
        ]);

        if (!$warga) {
            return response()->json([
                'status' => false,
                'message' => "Data gagal disimpan"
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data warga berhasil disimpan',
            'data' => $warga
        ]);
    }

    public function update(Request $request, $id)
    {
        $warga = Warga::find($id);
        if (!$warga) {
            return response()->json([
                'success' => false,
                'message' => "Data tidak ditemukan",
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:20|unique:warga,nik,' . $id,
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'tanggal_kematian' => 'nullable|date|after:tanggal_lahir',
            'alamat' => 'nullable|string|max:255',
            'status_keluarga' => 'required|string|max:50',
            'pekerjaan' => 'nullable|string|max:100',
            'agama' => 'required|string|max:50',
            'status_perkawinan' => 'required|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
            'pendidikan' => 'required|string|max:100|in:Tidak Sekolah,PAUD,TK,SD/Sederajat,SMP/Sederajat,SMA/Sederajat,Diploma,Sarjana,Pascasarjana,Lainnya',
            'no_kk' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $kk = \App\Models\Kk::where('no_kk', $request->no_kk)->first();
        if (!$kk) {
            $kk = new \App\Models\Kk;
            $kk->no_kk = $request->no_kk;
            $kk->save();
        }

        $warga->update([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'tanggal_kematian' => $request->tanggal_kematian,
            'pendidikan' => $request->pendidikan,
            'alamat' => $request->alamat,
            'status_keluarga' => $request->status_keluarga,
            'pekerjaan' => $request->pekerjaan,
            'agama' => $request->agama,
            'status_perkawinan' => $request->status_perkawinan,
            'kk_id' => $kk->id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data warga berhasil diupdate',
            'data' => $warga
        ]);
    }
}
