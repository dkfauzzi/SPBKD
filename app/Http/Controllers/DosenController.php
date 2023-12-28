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
use Illuminate\Support\Facades\Storage;


class DosenController extends Controller
{

    public function index()
    {
        $user = Auth::user()->NIP;

        $userDosen = User::where('NIP', '=', $user)->first();

        $imagePath = $userDosen->image_path;

        $dataDosen = QuarterDate::where('NIP', '=', $user)->get();

        return view('dosen.dosen-dashboard', compact('user', 'userDosen', 'dataDosen'));
    }


    public function update(Request $request)
    {
        $data = $request->validate([
            'NIP' => 'required',
            'nama' => 'required',
            'email' => 'required',
            'image' => 'nullable|image',
        ]);
        
        $user = Auth::user();
        
        if ($request->hasFile('image')) {
            // Delete existing image (if any)
            if ($user->image_path) {
                Storage::delete($user->image_path);
            }

            // Upload new image to the public/profile_image directory
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('profile_image', $imageName, 'public');

        
            $data['image_path'] = 'profile_image/' . $imageName;
        }
        
        $user->update($data);
        
        return redirect()->route('dosen-dashboard')->with('success', 'User updated successfully');
        
    }

    public function showUserProfile() {
        $user = Auth::user();
        return view('profile', compact('user'));
    }
    
}
