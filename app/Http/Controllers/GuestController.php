<?php

namespace App\Http\Controllers;

use App\Models\Kk;
use App\Services\statistik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{
    protected $statistik;
    public function __construct()
    {
        $this->statistik = new statistik;
    }

    public function index()
    {

        // jumlah keluarga
        $kk = Kk::count();

        // jumlah penduduk
        $penduduk = $this->statistik->penduduk->count();

        // klasifikasi umur
        $klasifikasi_umur = $this->statistik->usia();

        // jenis kelamin
        $jenis_kelamin = $this->statistik->jenis_kelamin();
        $perempuan = $jenis_kelamin->get('perempuan');
        $laki_laki = $jenis_kelamin->get('laki_laki');

        // pekerjaan
        $pekerjaan = $this->statistik->pekerjaan();
        $value_pekerjaan = $pekerjaan->get('value_pekerjaan');
        $lebel_pekerjaan = $pekerjaan->get('lebel_pekerjaan');


        // pendidikan
        $pendidikan = $this->statistik->pendidikan();
        $lebel_pendidikan = $pendidikan->get('lebel_pendidikan');
        $value_pendidikan = $pendidikan->get('value_pendidikan');

        return view('Guest', compact(
            'penduduk',
            'kk',
            'klasifikasi_umur',
            // jenis kelamin
            'laki_laki',
            'perempuan',
            // pekerjaan
            'lebel_pekerjaan',
            'value_pekerjaan',
            // pendidikan
            'lebel_pendidikan',
            'value_pendidikan',
        ));
    }

    public function loginPage()
    {
        if (session('is_admin')) {
            return redirect()->route('dashboard');
        }
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:4'
        ]);


        if (
            $request->email != env('EMAIL') ||
            $request->password != env('PASSWORD')
        ) {

            return redirect()->back()->with(
                [
                    'error' => 'Email Atau Password salah'
                ]
            );
        }

        session(['is_admin' => true]);
        if ($request->has('remember')) {
            return redirect()->route('dashboard')->withCookie(cookie('remember', true, 43200));
        }

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('is_admin');
        return redirect()->route('login')->withCookie(cookie()->forget('remember_admin'));
    }
}
