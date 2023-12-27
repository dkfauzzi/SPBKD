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

    //Prodi
    public function loginProdi()
    {
        return view('prodi.prodi-login');
    }

    //Prodi
    public function loginKK()
    {
        return view('kk.kk-login');
    }

    //Sekretariat 2
    public function loginSekretariat2()
    {
        return view('sekretariat2.sekretariat2-login');
    }

    //Dosen
    public function loginDosen()
    {
        return view('dosen.dosen-login');
    }

    //POST LOGIN

    //Dekan
    public function postLoginDekan(Request $request)
    {

        $credentials = $request->validate([
            'NIP' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session('')->regenerate();

            $user = Auth::user();

            $request->session()->put('userLevel', $user->level);

            return redirect()->intended('dekan-search');
        }

        return back()->withErrors([
            'NIP' => 'The provided credentials do not match our records.',
        ])->onlyInput('NIP');
    }

    //SEKRETARIAT 2
    public function PostLoginSekretariat2(Request $request)
    {

        $credentials = $request->validate([
            'NIP' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session('')->regenerate();

            $user = Auth::user();

            $request->session()->put('userLevel', $user->level);

            return redirect()->intended('sekretariat2-search');
        }

        return back()->withErrors([
            'NIP' => 'The provided credentials do not match our records.',
        ])->onlyInput('NIP');
    }

    //Prodi
    public function PostLoginProdi(Request $request)
    {

        $credentials = $request->validate([
            'NIP' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session('')->regenerate();

            $user = Auth::user();

            $request->session()->put('userLevel', $user->level);

            return redirect()->intended('prodi-dashboard');
        }

        return back()->withErrors([
            'NIP' => 'The provided credentials do not match our records.',
        ])->onlyInput('NIP');
    }

     //KK
     public function PostLoginKK(Request $request)
     {
 
        $credentials = $request->validate([
            'NIP' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session('')->regenerate();

            $user = Auth::user();

            $request->session()->put('userLevel', $user->level);

            return redirect()->intended('kk-dashboard');
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

            $user = Auth::user();

            $request->session()->put('userLevel', $user->level);

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
