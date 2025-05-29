<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Usaha;
use App\Models\Warga;
use App\Models\Kendaraan;
use App\Models\KepemelikanTanah;
use App\Models\KepemilikanTernak;
use Illuminate\Support\Facades\DB;
use App\Models\PenggunaanBahanBakar;
use App\Models\KepemilikanElektronik;
use App\Models\KepemilikanRumah;

class statistik
{

    public $penduduk;

    public function __construct()
    {
        $penduduk = Warga::all()->filter(function ($warga) {
            return !$warga->tanggal_kematian;
        })->map(function ($warga) {
            $warga->usia = (int) Carbon::parse($warga->tanggal_lahir)->age;
            return $warga;
        });

        $this->penduduk = $penduduk;
    }

    public function usia()
    {
        // usia
        // ["0–12 (Anak)", "13–18 (Remaja)", "19–59 (Dewasa)", "60+ (Lansia)"],


        $anak = $this->penduduk->where('usia', '<=', 12)->count();
        $remaja = $this->penduduk->where('usia', '>=', 13)->where('usia', '<=', 18)->count();
        $dewasa = $this->penduduk->where('usia', '>=', 19)->where('usia', '<=', 59)->count();
        $lansia = $this->penduduk->where('usia', '>=', 60)->count();
        $klasifikasi_umur =  [$anak, $remaja, $dewasa, $lansia];

        return $klasifikasi_umur;
    }

    public function jenis_kelamin()
    {
        //  jenis kelamin
        $perempuan = $this->penduduk->where('jenis_kelamin', 'Perempuan')->count();
        $laki_laki = $this->penduduk->where('jenis_kelamin', 'Laki-Laki')->count();
        $penduduk = $this->penduduk->count();

        return collect([
            'perempuan' => $perempuan,
            'laki_laki' => $laki_laki,
        ]);
    }

    public function pekerjaan()
    {

        // pekerjaan

        $pekerjaan_warga = $this->penduduk->pluck('pekerjaan')->countBy()->sortDesc();

        // ambil 4 teratas
        $count = 4;
        $upCount = $pekerjaan_warga->take($count);

        // mengambil value untuk ditampilkan
        $pekerjaan = $upCount->toArray();

        // menghitung jumlah sisa dari pekerjaan yang di ambil
        $sisa_pekerjaan = $pekerjaan_warga
            ->slice(- ($pekerjaan_warga->count() - $count));
        $lainnya = $sisa_pekerjaan->sum();

        $pekerjaan['lainnya'] = $lainnya;


        $value_pekerjaan = $pekerjaan;
        $lebel_pekerjaan = collect($value_pekerjaan)->keys()->toArray();

        return collect([
            'value_pekerjaan' => $value_pekerjaan,
            'lebel_pekerjaan' => $lebel_pekerjaan,
        ]);
    }

    public function pendidikan()
    {
        $item = $this->penduduk->pluck('pendidikan')->countBy();
        $pendidikan = collect([
            'Tidak Sekolah' => $item['Tidak Sekolah'],
            'PAUD' => $item['PAUD'],
            'SD' => $item['SD'],
            'SMP' => $item['SMP'],
            'SMA' => $item['SMA'],
            'Sarjana' => $item['Sarjana'],
        ]);

        $lebel_pendidikan = $pendidikan->keys()->toArray();
        $value_pendidikan = $pendidikan->values()->toArray();


        return collect([
            'lebel_pendidikan' => $lebel_pendidikan,
            'value_pendidikan' => $value_pendidikan
        ]);
    }

    public function usaha()
    {
        $allUsaha = Usaha::pluck('jenis_usaha')->countBy()->sortDesc();
        $param = 4;
        $usaha = $allUsaha->take($param);

        // Mengambil sisa data setelah 4 teratas
        $sisaUsaha = $allUsaha->slice($param);
        $jumlahSisa = $sisaUsaha->sum();

        // Tambahkan 'lainnya' jika ada sisa
        if ($jumlahSisa > 0) {
            $usaha['lainnya'] = $jumlahSisa;
        }
        return $usaha;
    }

    public function bahan_bakar()
    {
        $fields = ['solar', 'minyak_tanah', 'kayu_bakar', 'gas', 'lainnya'];
        $bahan_bakar = [];
        foreach ($fields as $field) {
            $bahan_bakar[$field] = PenggunaanBahanBakar::where($field, true)->count();
        }

        return collect($bahan_bakar);
    }

    public function kendaraan()
    {
        $fields = ['roda_2', 'roda_4', 'bus/truk', 'lainnya'];
        $kendaraan = [];
        foreach ($fields as $field) {
            $kendaraan[$field] = Kendaraan::where($field, '!=', 0)->sum($field);
        }
        return collect($kendaraan);
    }

    public function elektronik()
    {

        $elektronik = KepemilikanElektronik::pluck('jenis_elektronik')->countBy()->sortDesc();
        $param = 4;
        $paramElek = $elektronik->take($param);
        if ($paramElek->count() > 0) {
            $paramElek['lainnya'] = $elektronik->slice($param)->sum();
        }

        return $paramElek;
    }


    public function ternak()
    {
        $ternak = KepemilikanTernak::pluck('jenis_ternak')->countBy()->sortDesc();
        return $ternak;
    }

    public function rumah()
    {
        $rumah = KepemilikanRumah::pluck('status_rumah')->countBy()->sortDesc();
        return $rumah;
    }

    public function tipe_rumah()
    {
        $rumah = KepemilikanRumah::pluck('tipe_rumah')->countBy()->sortDesc();
        return $rumah;
    }

    public function tanah()
    {
        $tanah = KepemelikanTanah::pluck('jenis_tanah')->countBy()->sortDesc();
        $param = 4;
        $paramTanah = $tanah->take($param);
        if ($paramTanah->count() > 0) {
            $paramTanah['lainnya'] = $tanah->slice($param)->sum();
        }
        return $paramTanah;
    }
}
