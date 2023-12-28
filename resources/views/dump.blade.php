<?


public function index()
{
    $user = Auth::user()->NIP;

    $userDosen = User::where('NIP', '=', $user)->first();

    // Include 'image_path' attribute in the retrieved user data
    $userDosen->load('image_path');

    $dataDosen = QuarterDate::where('NIP', '=', $user)->get();

    return view('dosen.dosen-dashboard', compact('user', 'userDosen', 'dataDosen'));
}

