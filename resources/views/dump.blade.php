<?


class YourController extends Controller
{
    // Your existing methods...

    public function getDisplayValue($levelValue)
    {
        switch ($levelValue) {
            case 'ketuaKK':
                return 'Ketua Kelompok Keahlian';
            // Add more cases as needed
            default:
                return $levelValue;
        }
    }
    
    public function edit($NIP)
    {
        // Fetch data from the database, including JAD values
        $data = User::where('NIP', $NIP)->first();
        $jadValues = User::pluck('JAD')->unique();
        $prodiValues = User::pluck('Prodi')->unique();
        $kkValues = User::pluck('KK')->unique(); 
        $levelValues = User::pluck('level')->unique(); 

        return view('sekretariat2.sekretariat2-dosen-edit', compact('data', 'jadValues','prodiValues','kkValues','levelValues'));
    }
}
