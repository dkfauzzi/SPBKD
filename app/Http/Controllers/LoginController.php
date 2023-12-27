<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Authentication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Dekan;
use App\Models\Dosen;
use App\Models\Sekretariat;
use App\Models\User;



class LoginController extends Controller
{

    public function auth(Request $request)
    {
        $NIP = $request->input('inputNIP');
        $password = $request->input('inputPassword');

        if (Auth::attempt(['NIP' => $NIP, 'password' => $password, 'level' => 'dekan'])) {
            Session::regenerate();
            Session::put('loggedNIP', $NIP);
            $loggedNIP = Session::get('loggedNIP');
            Dekan::firstOrCreate(['NIP' => $loggedNIP]);
            return redirect()->intended('dekan.dekan-search');

        } elseif (Auth::attempt(['NIP' => $NIP, 'password' => $password, 'level' => 'kaprodi'])) {
            Session::regenerate();
            Session::put('loggedNIP', $NIP);
            $loggedNIP = Session::get('loggedNIP');
            return redirect()->intended('prodi.prodi-dashboard');

        } elseif (Auth::attempt(['NIP' => $NIP, 'password' => $password, 'level' => 'ketuaKK'])) {
            Session::regenerate();
            Session::put('loggedNIP', $NIP);
            $loggedNIP = Session::get('loggedNIP');
            return redirect()->intended('kk.kk-dashboard');

        } elseif (Auth::attempt(['NIP' => $NIP, 'password' => $password, 'level' => 'dosen'])) {
            Session::regenerate();
            Session::put('loggedNIP', $NIP);
            $loggedNIP = Session::get('loggedNIP');
            return redirect()->intended('dosen.dosen-dashboard');

        } elseif (Auth::attempt(['NIP' => $NIP, 'password' => $password, 'level' => 'sekretariat2'])) {
            Session::regenerate();
            Session::put('loggedNIP', $NIP);
            $loggedNIP = Session::get('loggedNIP');
            return redirect()->intended('sekretariat2.sekretariat2-dashboard');

        }
        
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/');
    }
}