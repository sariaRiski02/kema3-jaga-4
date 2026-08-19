<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\Resident;
use App\Services\ResidentStatService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{

    protected $residentStatService;
    public function __construct()
    {
        $this->residentStatService = new ResidentStatService();
    }

    public function index()
    {
        
        $resident = $this->residentStatService;
        $families = Family::all();
        return view('guest.main', compact('resident', 'families'));
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
