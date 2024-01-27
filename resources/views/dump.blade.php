<?

public function store(Request $request)
    {
        // Set data to store
        $data = $request->validate([
            'start_date' => 'required|array',
            'start_date.*' => 'required|date',
            'end_date' => 'required|array',
            'end_date.*' => 'required|date',
            'sk' => 'required|array',
            'sk.*' => 'required',
            'sks' => 'required|array',
            'sks.*' => 'required',
            'jenis_sk' => 'required|array',
            'jenis_sk.*' => 'required',
            'keterangan_sk' => 'null|array',
            'keterangan_sk.*' => 'null',
            'NIP' => 'required|array',
            'NIP.*' => 'required',
            'nama' => 'required|array',
            'nama.*' => 'required',
            'bukti' => 'required|mimes:pdf,jpg,png,doc,docx|max:25000',
            'bukti.*' => 'required|mimes:pdf,jpg,png,doc,docx|max:25000',

        ]);

        // upload bukti
        if ($request->hasFile('bukti')) {
            $bukti = $request->file('bukti');
            $namaBukti = time() . '_' . $bukti->getClientOriginalName();
            $bukti->storeAs('bukti_sk', $namaBukti, 'public');

            $data['bukti'] = $namaBukti;
        }
    
        // Initialize $quartersData outside the loop
        $quartersData = [];
    
        // Loop through the array of NIPs
        foreach ($data['NIP'] as $key => $nip) {
            // Set mulainya bulan dan tanggal TW. Contoh 1(1,1) = TW1 (bulan januari, tanngal 1)
            $quarterStarts = [
                1 => \Carbon\Carbon::createFromDate(\Carbon\Carbon::parse($data['start_date'][0])->year, 1, 1),
                2 => \Carbon\Carbon::createFromDate(\Carbon\Carbon::parse($data['start_date'][0])->year, 4, 1),
                3 => \Carbon\Carbon::createFromDate(\Carbon\Carbon::parse($data['start_date'][0])->year, 7, 1),
                4 => \Carbon\Carbon::createFromDate(\Carbon\Carbon::parse($data['start_date'][0])->year, 10, 1),
            ];
    
            // Set berakhirnya bulan dan tanggal TW. Contoh 1(3,31) = TW1(bulan maret, tanngal 31)
            $quarterEnds = [
                1 => \Carbon\Carbon::createFromDate(\Carbon\Carbon::parse($data['start_date'][0])->year, 3, 31),
                2 => \Carbon\Carbon::createFromDate(\Carbon\Carbon::parse($data['start_date'][0])->year, 6, 30),
                3 => \Carbon\Carbon::createFromDate(\Carbon\Carbon::parse($data['start_date'][0])->year, 9, 30),
                4 => \Carbon\Carbon::createFromDate(\Carbon\Carbon::parse($data['start_date'][0])->year, 12, 31),
            ];
            

            $entry = [
                'NIP' => $nip,
                'nama' => $data['nama'][$key],
                'sk' => $data['sk'][0], //starts from key 0 
                'sks' => $data['sks'][0], 
                'jenis_sk' => $data['jenis_sk'][0], 
                // 'bukti' => $data['bukti'][0], 
                // 'keterangan_sk' => $data['keterangan_sk'][0], 
                'start_date' => \Carbon\Carbon::parse($data['start_date'][0]),
                'end_date' => \Carbon\Carbon::parse($data['end_date'][0]),
            ];
        
            // Loop through quarters
            for ($quarter = 1; $quarter <= 4; $quarter++) {
                $qStart = $quarterStarts[$quarter];
                $qEnd = $quarterEnds[$quarter];
        
                if ($entry['end_date'] < $qStart || $entry['start_date'] > $qEnd) {
                    // If outside the quarter, leave the columns empty
                    $entry["q{$quarter}_start"] = null;
                    $entry["q{$quarter}_end"] = null;
                } else {
                    // If inside the quarter, insert into columns
                    $entry["q{$quarter}_start"] = max($entry['start_date'], $qStart);
                    $entry["q{$quarter}_end"] = min($entry['end_date'], $qEnd);
                }
            }
        
            // Set start and end SK dates
            $entry['start_sk'] = $entry['start_date']->year . '-Q' . ceil($entry['start_date']->month / 3);
            $entry['end_sk'] = $entry['end_date']->year . '-Q' . ceil($entry['end_date']->month / 3);
            

            // Add the entry to $quartersData array
            $quartersData[] = $entry;
            $quartersData[$key]['bukti'] = $data['bukti'];

        }
    
        // Loop through the prepared $quartersData array and create entries in the database
        foreach ($quartersData as $dataEntry) {
            // Create entry in the database
            QuarterDate::create($dataEntry);
        }
    
        return redirect()->route('sekretariat2-search');
    }