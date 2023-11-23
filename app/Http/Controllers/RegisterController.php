<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class RegisterController extends Controller
{
    public function create()
    {
        return view('sekretariat2.sekretariat2-register');
    }

    public function store(Request $request)
    {
        // Validate the form data
        $data = $request->validate([
            'nama' => 'required',
            'JAD' => 'required',
            'NIP' => 'required',
            'Prodi' => 'required',
            'KK' => 'required',
            'email' => 'required',
            'password' => 'required',
            'level' => 'required',
            // Add any other fields you need
        ]);

        // Create a new user
        $user = User::create($data);

        // Redirect or perform any other action as needed
        return redirect()->route('sekretariat2-search')->with('success', 'User registered successfully');
    }
}
