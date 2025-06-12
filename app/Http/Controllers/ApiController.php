<?php

namespace App\Http\Controllers;

use App\Models\Kk;
use App\Models\Warga;
use App\Imports\WargaImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function getAllResident()
    {
        $data = Warga::with('kk')->latest()->paginate(20);
        if (!$data) {
            return response()->json([
                'success' => false,
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
        // Normalisasi enum ke lowercase
        $enumFields = [
            'jenis_kelamin',
            'status_keluarga',
            'agama',
            'status_perkawinan',
            'pendidikan'
        ];
        foreach ($enumFields as $field) {
            if ($request->has($field)) {
                $request[$field] = strtolower(trim($request[$field]));
            }
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:20|unique:warga,nik',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'tanggal_kematian' => 'nullable|date|after:tanggal_lahir',
            'alamat' => 'nullable|string|max:255',
            'status_keluarga' => 'required|string|max:50',
            'pekerjaan' => 'nullable|string|max:100',
            'agama' => 'required|string|max:50',
            'status_perkawinan' => 'required|in:belum kawin,kawin,cerai hidup,cerai mati',
            'pendidikan' => 'required|string|max:100|in:tidak sekolah,paud,tk,sd/sederajat,smp/sederajat,sma/sederajat,diploma,sarjana,pascasarjana,lainnya',
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
        // Normalisasi enum ke lowercase
        $enumFields = [
            'jenis_kelamin',
            'status_keluarga',
            'agama',
            'status_perkawinan',
            'pendidikan'
        ];
        foreach ($enumFields as $field) {
            if ($request->has($field)) {
                $request[$field] = strtolower(trim($request[$field]));
            }
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:20|unique:warga,nik,' . $id,
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'tanggal_kematian' => 'nullable|date|after:tanggal_lahir',
            'alamat' => 'nullable|string|max:255',
            'status_keluarga' => 'required|string|max:50',
            'pekerjaan' => 'nullable|string|max:100',
            'agama' => 'required|string|max:50',
            'status_perkawinan' => 'required|in:belum kawin,kawin,cerai hidup,cerai mati',
            'pendidikan' => 'required|string|max:100|in:tidak sekolah,paud,tk,sd/sederajat,smp/sederajat,sma/sederajat,diploma,sarjana,pascasarjana,lainnya',
            'no_kk' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $kk = Kk::where('no_kk', $request->no_kk)->first();
        if (!$kk) {
            $kk = new Kk;
            $kk->no_kk = $request->no_kk;
            $kk->save();
        }

        $result = $warga->update([
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

        if (!$result) {
            return response()->json([
                'success' => false,
                'message' => 'data gagal disimpan'
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Data warga berhasil diupdate',
            'data' => $warga
        ]);
    }

    /**
     * Import data warga dari file Excel
     */
    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv,txt|max:10240',
        ]);
        try {
            Excel::import(new WargaImport, $request->file('file'));
            return response()->json([
                'success' => true,
                'message' => 'Data warga berhasil diimport.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal import: ' . $e->getMessage()
            ], 500);
        }
    }

    // Mendapatkan semua anggota keluarga berdasarkan no_kk
    public function getFamilyMembers($no_kk)
    {

        $kk = Kk::where('no_kk', $no_kk)->first();

        if (!$kk) {
            return response()->json([
                'success' => false,
                'message' => 'Nomor KK tidak ditemukan'
            ], 404);
        }

        // Get family members sorted by status (kepala keluarga first)
        $familyMembers = $kk->warga()
            ->orderByRaw("CASE WHEN LOWER(status_keluarga) = 'kepala keluarga' THEN 1 WHEN LOWER(status_keluarga) = 'istri' THEN 2 WHEN LOWER(status_keluarga) = 'anak' THEN 3 ELSE 4 END")
            ->get();
        return response()->json([
            'success' => true,
            'data' => [
                'no_kk' => $kk->no_kk,
                'members' => $familyMembers
            ]
        ]);
    }
    // end fitur belum jalan

    // Hapus data warga secara massal
    public function massDelete(Request $request)
    {
        $ids = $request->input('ids');
        if (!is_array($ids) || empty($ids)) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada data yang dipilih untuk dihapus.'
            ], 400);
        }
        $deleted = Warga::whereIn('id', $ids)->delete();
        return response()->json([
            'success' => true,
            'message' => "$deleted data berhasil dihapus."
        ]);
    }
}
