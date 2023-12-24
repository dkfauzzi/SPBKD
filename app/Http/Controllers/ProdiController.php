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

        // Get data from the 'User' table for the current user
        $userDosen = User::where('NIP', '=', $user)->first();

        // Get data from the 'QuarterDate' table for the current user
        $dataDosen = QuarterDate::where('NIP', '=', $user)->get();

        // Pass the data to the view
        return view('prodi.prodi-dashboard', compact('user', 'userDosen', 'dataDosen'));
    }

}
