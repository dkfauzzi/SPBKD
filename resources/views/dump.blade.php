<?
        <div class="main-content">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card border border-2">
                            <div class="card-header">
                                <h4>Grafik DATA SKS</h4>
                            </div>
                            <div class="card-body table-responsive">
                                <div class="col">
                                    <div class="row d-flex justify-content-center">   
                                        <canvas id="prodi_SKS" width="400" height="300"></canvas>
                                        <canvas id="kk_SKS" width="400" height="300"></canvas>
                                        <canvas id="dosen_SKS" width="400" height="300"></canvas>


                                        <script>
                                            document.addEventListener("DOMContentLoaded", function() {
                                                fetch('/chart/data-sks')
                                                    .then(response => response.json())
                                                    .then(data => {
                                                        var ctxProdi = document.getElementById('prodi_SKS').getContext('2d');
                                                        var prodiChart = new Chart(ctxProdi, {
                                                            type: 'bar',
                                                            data: {
                                                                labels: Object.keys(data.prodi_sks),
                                                                datasets: [{
                                                                    label: 'SKS Tiap Prodi',
                                                                    data: Object.values(data.prodi_sks),
                                                                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                                                    borderColor: 'rgba(255, 99, 132, 1)',
                                                                    borderWidth: 1
                                                                }]
                                                            },
                                                            options: {
                                                                responsive: false,
                                                                maintainAspectRatio: false,
                                                                scales: {
                                                                    x: {},
                                                                    y: {}
                                                                }
                                                            }
                                                        });

                                                        var ctxProdi = document.getElementById('kk_SKS').getContext('2d');
                                                        var prodiChart = new Chart(ctxProdi, {
                                                            type: 'bar',
                                                            data: {
                                                                labels: Object.keys(data.kk_sks),
                                                                datasets: [{
                                                                    label: 'SKS Tiap Kelompok Keahlian',
                                                                    data: Object.values(data.kk_sks),
                                                                    backgroundColor: 'rgba(0, 128, 0, 0.2)',
                                                                    borderColor: 'rgba(0, 128, 0, 1)',
                                                                    borderWidth: 1
                                                                }]
                                                            },
                                                            options: {
                                                                responsive: false,
                                                                maintainAspectRatio: false,
                                                                scales: {
                                                                    x: {},
                                                                    y: {}
                                                                }
                                                            }
                                                        });


                                                        var ctxProdi = document.getElementById('dosen_SKS').getContext('2d');
                                                        var prodiChart = new Chart(ctxProdi, {
                                                            type: 'bar',
                                                            data: {
                                                                labels: Object.keys(data.dosen_sks),
                                                                datasets: [{
                                                                    label: 'SKS Tiap Dosen',
                                                                    data: Object.values(data.dosen_sks),
                                                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                                                    borderColor: 'rgba(75, 192, 192, 1)',
                                                                    borderWidth: 1
                                                                }]
                                                            },
                                                            options: {
                                                                responsive: false,
                                                                maintainAspectRatio: false,
                                                                scales: {
                                                                    x: {},
                                                                    y: {}
                                                                }
                                                            }
                                                        });





                                                    });
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>

                        

                    </div>
                </div>
            </div>
        </div>

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
