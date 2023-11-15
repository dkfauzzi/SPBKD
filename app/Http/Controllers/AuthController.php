<?php

namespace App\Http\Controllers;

use App\Models\Authentication;
// use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //Dekan
    public function loginDekan()
    {
        return view('dekan.dekan-login');
    }

    //Sekretariat
    public function loginSekretariat()
    {
        return view('sekretariat.sekretariat-login');
    }

    //Dosen
    public function loginDosen()
    {
        return view('dosen.dosen-login');
    }

    //POST LOGIN

    public function postLoginDekan(Request $request)
    {

        // if (Auth::attempt($request->only('username', 'password'))) {
        //     return redirect('dashboard-mahasiswa');
        // }
        // return view('login-mahasiswa');

        $credentials = $request->validate([
            'NIP' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session('')->regenerate();

            return redirect()->intended('dekan-dashboard');
        }

        return back()->withErrors([
            'NIP' => 'The provided credentials do not match our records.',
        ])->onlyInput('NIP');
    }

    //SEKRETARIAT
    public function PostLoginSekretariat(Request $request)
    {

        $credentials = $request->validate([
            'NIP' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session('')->regenerate();

            return redirect()->intended('sekretariat-dashboard');
        }

        return back()->withErrors([
            'NIP' => 'The provided credentials do not match our records.',
        ])->onlyInput('NIP');
    }

    //DOSEN
    public function PostLoginDosen(Request $request)
    {
        $credentials = $request->validate([
            'NIP' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session('')->regenerate();

            return redirect()->intended('dosen-dashboard');
        }

        return back()->withErrors([
            'NIP' => 'The provided credentials do not match our records.',
        ])->onlyInput('NIP');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('');
    }
}
