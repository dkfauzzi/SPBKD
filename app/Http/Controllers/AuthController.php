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

    //DEKAN
    public function postLoginDekan(Request $request)
    {
        $credentials = $request->validate([
            'NIP' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            $dekanLevels = ['dekan', 'wakildekan1', 'wakildekan2'];

            if (in_array($user->level, $dekanLevels)) {
                $request->session()->regenerate();
                $request->session()->put('userLevel', $user->level);
                return redirect()->intended('dekan-search');
            } else {
                Auth::logout();
                return redirect()->route('dekan-login')->with('warning', 'Login Khusus Dekanat.<br>Mohon gunakan halaman login yang lain');
            }
        }

        return back()->withErrors([
            'NIP' => 'Username atau password salah.',
        ])->withInput();
    }

    //SEKRETARIAT 2
    public function PostLoginSekretariat2(Request $request)
    {

        $credentials = $request->validate([
            'NIP' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->level === 'sekretariat2') {
                $request->session()->regenerate();
                $request->session()->put('userLevel', $user->level);
                return redirect()->intended('sekretariat2-search');
            } else {
                Auth::logout();
                return redirect()->route('sekretariat2-login')->with('warning', 'Login Khusus Sekretariat.<br>Mohon gunakan halaman login yang lain');
            }
        }

        return back()->withErrors([
            'NIP' => 'Username atau password salah.',
        ])->withInput();
    }

    //Prodi
    public function PostLoginProdi(Request $request)
    {

        $credentials = $request->validate([
            'NIP' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->level === 'kaprodi') {
                $request->session()->regenerate();
                $request->session()->put('userLevel', $user->level);
                return redirect()->intended('dekan-search');
            } else {
                Auth::logout();
                return redirect()->route('prodi-login')->with('warning', 'Login Khusus Program Studi.<br>Mohon gunakan halaman login yang lain');
            }
        }

        return back()->withErrors([
            'NIP' => 'Username atau password salah.',
        ])->withInput();;
    }

     //KK
     public function PostLoginKK(Request $request)
     {
 
        $credentials = $request->validate([
            'NIP' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->level === 'ketuaKK') {
                $request->session()->regenerate();
                $request->session()->put('userLevel', $user->level);
                return redirect()->intended('dekan-search');
            } else {
                Auth::logout();
                return redirect()->route('kk-login')->with('warning', 'Login Khusus Ketua Kelompok.<br>Mohon gunakan halaman login yang lain');
            }
        }

        return back()->withErrors([
            'NIP' => 'Username atau password salah.',
        ])->withInput();
     }

   

    //DOSEN
    public function PostLoginDosen(Request $request)
    {
        $credentials = $request->validate([
            'NIP' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->level === 'dosen') {
                $request->session()->regenerate();
                $request->session()->put('userLevel', $user->level);
                return redirect()->intended('dosen-dashboard');
            } else {
                Auth::logout();
                return redirect()->route('dosen-login')->with('warning', 'Login Khusus Dosen.<br>Mohon gunakan halaman login yang lain');
            }
        }

        return back()->withErrors([
            'NIP' => 'Username atau password salah.',
        ])->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect('');
    }
}
