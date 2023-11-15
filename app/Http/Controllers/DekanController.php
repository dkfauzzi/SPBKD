<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dekan;
use App\Models\SK_Dosen;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DekanController extends Controller
{
    public function index()
    {
        // $data['mahasiswa'] = Mahasiswa::all();
        // $username = Auth::user()->username;
        // $data['user'] = User::where('username', '=', $username)->get();
        $data['sk_dosen'] = SK_Dosen::all();
        return view('dekan.dekan-dashboard', $data);
    }
}