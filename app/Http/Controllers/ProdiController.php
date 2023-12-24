<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sekretariat;
use App\Models\SK_Dosen;
use App\Models\QuarterDate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProdiController extends Controller
{
    public function index()
    {
        $user = Auth::user()->NIP;

        $userDosen = User::where('NIP', '=', $user)->first();

        $dataDosen = QuarterDate::where('NIP', '=', $user)->get();

        return view('prodi.prodi-dashboard', compact('user', 'userDosen', 'dataDosen'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'NIP'=> 'required',
            'nama'=> 'required',
            'email'=> 'required',
        ]);
    
        $user = Auth::user();
        $user->update($data);
    
        return redirect()->route('prodi-dashboard')->with('success', 'User updated successfully');
    }
    

}
