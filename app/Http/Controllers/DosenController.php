<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DosenController extends Controller
{
    public function index()
    {
        // $data['mahasiswa'] = Mahasiswa::all();
        // $username = Auth::user()->username;
        // $data['user'] = User::where('username', '=', $username)->get();
        // $data['user'] = User::all()->where('level', 'dosen');
        // return view('dosen.dosen-dashboard', $data);
    }
}