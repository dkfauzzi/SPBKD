<?


use Barryvdh\DomPDF\Facade as PDF;
use App\Models\QuarterDate; // Make sure to import the QuarterDate model

public function generatePDF($NIP)
{
    // Fetch data and convert it to an array
    $data = QuarterDate::where('NIP', $NIP)->first()->toArray();

    $pdf = PDF::loadView('your.view', compact('data'));

    return $pdf->download('filename.pdf');
}


public function pdf($NIP) {
    try {
        // Fetch the QuarterDate model for the given NIP
        $quarterDate = QuarterDate::where('NIP', $NIP)->firstOrFail();

        // Debugging statement
        dd($quarterDate);

        // Check if sk property exists in the model
        if (!property_exists($quarterDate, 'sk')) {
            throw new \Exception("Property 'sk' not found in QuarterDate model");
        }

        $data = $quarterDate->toArray();

        $pdf = PDF::loadView('sekretariat2.print', compact('data'));
        return $pdf->stream();
    } catch (ModelNotFoundException $e) {
        // Handle the case where no record is found for the given NIP
        return redirect()->back()->with('error', 'Data not found for NIP: ' . $NIP);
    } catch (\Exception $e) {
        // Handle any other exceptions
        return redirect()->back()->with('error', $e->getMessage());
    }
}


public function pdf($NIP) {
    try {
        // Fetch the QuarterDate models for the given NIP
        $quarterDates = QuarterDate::where('NIP', $NIP)->get();

        // Debugging statement
        dd($quarterDates->toArray());

        $pdf = PDF::loadView('sekretariat2.print', compact('quarterDates'));
        return $pdf->stream();
    } catch (ModelNotFoundException $e) {
        // Handle the case where no record is found for the given NIP
        return redirect()->back()->with('error', 'Data not found for NIP: ' . $NIP);
    } catch (\Exception $e) {
        // Handle any other exceptions
        return redirect()->back()->with('error', $e->getMessage());
    }
}


$quarterDate = \Illuminate\Support\Facades\DB::table('test_sk_dosen')->where('NIP', $NIP)->first();

// Debugging statement
dd($quarterDate);

$pdf = PDF::loadView('sekretariat2.print', compact('quarterDate'));

if ($quarterDate) {
    // The record was found
    // Access properties like $quarterDate->sks here
} else {
    // The record was not found
    return redirect()->back()->with('error', 'Data not found for NIP: ' . $NIP);
}

$data['kp_form001'] = Form001::findOrFail($id)
            ->select('username', 'nama', 'perusahaan1', 'alamat_perusahaan1', 'bidang_perusahaan1', 'perusahaan2', 'alamat_perusahaan2', 'bidang_perusahaan2')
            ->where('id', '=', $id)
            ->get($id);
        $pdf = PDF::loadView('tata-usaha.generate-form-001', $data);
        return $pdf->stream();