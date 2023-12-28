<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;



class RegisterController extends Controller
{
    public function create()
    {
        return view('sekretariat2.sekretariat2-register');
    }

    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'nama' => 'required',
            'JAD' => 'required',
            'NIP' => 'required|unique:users,NIP', // harus unique
            'Prodi' => 'required',
            'KK' => 'required',
            'email' => 'required|unique:users,email', // harus unique
            'password' => 'required',
            'level' => 'required',
        ], [
            'NIP.unique' => 'NIP sudah digunakan. Silakan pilih yang lain.',
            'email.unique' => 'Email sudah digunakan. Silakan pilih yang lain.',
        ]);
    
        $user = User::create($request->all());
    
        return redirect()->route('sekretariat2-search')->with('success', 'User registered successfully');
    }
    
    
    
}
