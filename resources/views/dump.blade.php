<?
<!-- Add this script at the bottom of your Blade view, after including jQuery -->
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            // Counter for unique field names
            let counter = 1;

            // Handle button click event
            $('#addFieldsBtn').click(function () {
                // Clone the NIP and Nama fields
                let newNIPField = $('#nipField').clone(true, true);
                let newNamaField = $('#namaField').clone(true, true);

                // Update attributes to make them unique
                newNIPField.find('input').attr({
                    'id': 'nip_' + counter,
                    'name': 'NIP[]',  // Use an array for multiple NIP fields
                    'readonly': false  // Allow editing in the cloned fields
                });

                newNamaField.find('input').attr({
                    'id': 'nama_' + counter,
                    'name': 'nama[]',  // Use an array for multiple nama fields
                    'readonly': false  // Allow editing in the cloned fields
                });

                // Create a new row and append both cloned fields to it
                let newRow = $('<div class="form-row"></div>').append(
                    $('<div class="form-group col-md-6"></div>').append(newNIPField.html())
                ).append(
                    $('<div class="form-group col-md-6"></div>').append(newNamaField.html())
                );

                // Insert the new row above the "Add More Fields" button within the specific form-row with class 'button'
                $('.form-row.button').before(newRow);

                // Increment the counter for the next set of fields
                counter++;
            });
        });
    </script>
@endpush



public function PostLoginDosen(Request $request)
{
    $credentials = $request->validate([
        'NIP' => ['required'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        // Retrieve the authenticated user
        $user = Auth::user();

        // Pass the user level to the view
        return redirect()->intended('dosen-dashboard')->with('userLevel', $user->level);
    }

    return back()->withErrors([
        'NIP' => 'The provided credentials do not match our records.',
    ])->onlyInput('NIP');
}




========================================

<div class="form-group">
    <div class="form-col">
        <!-- Existing fields for NIP and Nama -->
        <div class="form-row">
            <div class="form-group col-md-6" id="nipField">
                <label for="NIP">NIP</label><br>
                <input class="form-control nip-field" type="text" name="NIP[]" readonly>
            </div>

            <div class="form-group col-md-6">
                <label for="nama">Nama Dosen</label>
                <input class="form-control nama-field" type="text" name="nama[]" readonly>
                <div class="invalid-feedback">Isi Nama Dosen</div>
            </div>
        </div>

        <!-- Add more fields button -->
        <div class="form-row">
            <div class="form-group col-md-6">
                <button type="button" class="btn btn-primary" id="addFieldsBtn">Add More Fields</button>
            </div>
        </div>

        <!-- Other fields -->
        <div class="form-row">
            <!-- Remaining fields go here -->
        </div>
    </div>
</div>
