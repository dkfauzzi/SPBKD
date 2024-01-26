<?


public function update($id, Request $request)
    {
       
        $this->validate($request, [
            'surat' => "mimes:pdf|max:5000",
        ]);

        $input = $request->all();
        // $input['status'] = "Diproses";

        if ($suratPengantar = $request->file('surat')) {
            $destinationPath = 'Surat_Pengantar/';
            $suratWaktu = time() . "_" . $suratPengantar->getClientOriginalName();
            $suratPengantar->move($destinationPath, $suratWaktu);
            $input['surat'] = "$suratWaktu";
        } else {
            unset($input['surat']);
        }

        Form001::find($id)->update($input);
        return redirect('dashboard-tata-usaha-form-001')->with('success', 'Daftar KP created successfully.');
    }


    public function store(Request $request)
    {
        try {
            $this->validate($request, [

                'laporan' => "mimes:pdf|max:25000",
                'id_kp' => 'required',
                'id_sidang_kp' => 'required',
            ]);

            $input = $request->all();
            $input['status'] = "Diproses";

            if ($draft = $request->file('laporan')) {
                $destinationPath = 'Laporan_KP/';
                $draftTA = time() . "_" . $draft->getClientOriginalName();
                $draft->move($destinationPath, $draftTA);
                $input['laporan'] = "$draftTA";
            }

            sidang_kp::create($input);

            return redirect('dashboard-mahasiswa-sidang-kp')->with('success', 'Daftar TA created successfully.');
        } catch (QueryException $e) {
            abort(403, 'ANDA BELUM MENDAFTAR KERJA PRAKTIK/DAFTAR SIDANG HANYA DAPAT SATU KALI!!!.');
            // throw new \Exception('Terjadi kesalahan dalam menjalankan query. Sepertinya Anda belum mendaftar Tugas Akhir  ');
        }
    }


============================

public function store(Request $request)
{
    // Validate form data
    $data = $request->validate([
        // Your existing validation rules
    ]);

    // Handle file upload
    if ($request->hasFile('file')) {
        $file = $request->file('file');
        // You can add additional file validation rules here if needed
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('uploads', $fileName, 'public');

        // Add the file name to your $data array or save it as needed
        $data['file'] = $fileName;
    }

    // Your existing code for processing form data

    // Create entry in the database
    QuarterDate::create($data);

    return redirect()->route('sekretariat2-search');
}
=======================

use Illuminate\Http\Request;

public function store(Request $request)
{
    // Validate form data
    $data = $request->validate([
        // Your existing validation rules
    ]);

    // Handle file upload
    if ($request->hasFile('file')) {
        $file = $request->file('file');
        // You can add additional file validation rules here if needed
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('uploads', $fileName, 'public');

        // Add the file name to your $data array
        $data['file'] = $fileName;
    }

    // Initialize $quartersData outside the loop
    $quartersData = [];

    // Loop through the array of NIPs
    foreach ($data['NIP'] as $key => $nip) {
        // ... (your existing code to prepare $quartersData)

        // Add the file information to the current $entry
        $quartersData[$key]['file'] = $data['file'];
    }

    // Loop through the prepared $quartersData array and create entries in the database
    foreach ($quartersData as $dataEntry) {
        // Create entry in the database
        QuarterDate::create($dataEntry);
    }

    return redirect()->route('sekretariat2-search');
}
