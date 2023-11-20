<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sekretariat;
use App\Models\SK_Dosen;
use App\Models\QuarterDate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class CardController extends Controller
{
    public function index()
    {
        $data = User::all();

        return view('sekretariat2.card', compact('data'));
    }

    public function show(User $user)
    {
        $data = QuarterDate::all();
        return view('sekretariat2.show', ['user' => $user], compact('data'));
    }

    // public function show(User $card)
    // {
    //     return view('sekretariat2.show', ['card' => $card]);
    //     // return view('sekretariat2.show', compact('data'));

    // }
}

