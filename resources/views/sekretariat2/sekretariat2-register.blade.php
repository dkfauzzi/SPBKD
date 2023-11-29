<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Register - Dekan</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="/assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/modules/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/modules/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/qr-code-scanner.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="/assets/modules/datatables/datatables.min.css">
    <link rel="stylesheet" href="/assets/modules/sweetalert2/sweetalert2.scss">
    <link rel="stylesheet" href="/assets/modules/summernote/summernote-bs4.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/components.css">
    @stack('template-css')

    <!-- Plugins -->
    @stack('plugins-css')
    
</head>

<body style="background-image: url('assets_index/assets/img/TULT-hijau.jpg'); background-size: cover;">
    <div id="">
        <section class="section">
            <div class="container mt-5"  >
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6  col-lg-6 col-xl-4 offset-xl-3">
                        {{-- <div class="login-brand">
                            <a href="/"><img src="assets_index/assets/img/logo-fri-putih.png" alt="logo" width="300"></a>
                        </div> --}}
                        <div class="card mt-5" style="width: 600px">
                            <img class="card-img-top bg-transparent" src="assets_index/assets/img/logo-fri-hijau.png" alt="Card image cap" width="150px">
                            <div class="card-header ">
                                <h4>Register Akun </h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('sekretariat2-search') }}" method="POST">
                                {{-- <form action="post-login-dekan" method="POST"> --}}
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <label for="username">NIP</label>
                                        <input  type="text" class="form-control" name="NIP" tabindex="1" required autofocus>
                                        <div class="invalid-feedback">
                                            Isi NIP Dosen
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="username">Nama</label>
                                        <input type="text" class="form-control" name="nama" tabindex="1" required autofocus>
                                        <div class="invalid-feedback">
                                            Isi Nama Dosen
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="username">JAD</label>
                                        <select class="form-select" aria-label="Default select example" name="JAD">
                                            <option value="Guru Besar">Guru Besar</option>
                                            <option value="Kepala Lektor">Kepala Lektor</option>
                                            <option value="Lektor">Lektor</option>
                                            <option value="Asisten Ahli">Asisten Ahli</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Isi JAD Dosen
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="username">Program Studi</label>
                                        <select class="form-select" aria-label="Default select example" name="Prodi">
                                            <option value="S1 Teknik Industri">S1 Teknik Industri</option>
                                            <option value="S2 Teknik Industri">S2 Teknik Industri</option>
                                            <option value="S2 Teknik Industri">S1 Sistem Informasi</option>
                                            <option value="S2 Teknik Industri">S2 Sistem Informasi</option>
                                            <option value="S2 Teknik Industri">S1 Digital Supply Chain</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Isi Prodi Dosen
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Kelompok Keahlian</label>
                                        <select class="form-select" aria-label="Default select example" name="KK">
                                            <option value="CYBERNET">CYBERNET</option>
                                            <option value="EINS">EINS</option>
                                            <option value="PROMASYS">PROMASYS</option>
                                            <option value="ENGINEERING MANAGEMENT">ENGINEERING MANAGEMENT</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Isi Kelompok Keahlian Dosen
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="username">Role Pada Website</label>
                                        <select class="form-select" aria-label="Default select example" name="level">
                                            <option value="dekan">Dekan</option>
                                            <option value="wd1">Wakil Dekan 1</option>
                                            <option value="wd2">Wakil Dekan 2</option>
                                            <option value="kaprodi">Ketua Program Studi</option>
                                            <option value="ketuaKK">Ketua Kelompok Keahlian</option>
                                            <option value="dosen">Dosen</option>
                                            <option value="sekretariat">Sekretariat</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Isi Role Dosen
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="username">Email</label>
                                        <input type="text" class="form-control" name="email" tabindex="1" required autofocus>
                                        <div class="invalid-feedback">
                                            Isi Email Dosen
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password" class="control-label">Password</label>
                                        </div>
                                        <input id="password" type="password" class="form-control" name="password" tabindex="2" required autofocus>
                                        <div class="invalid-feedback">
                                            Isi Passwordd Dosen
                                        </div>
                                    </div>
                                    
                                    <div class="row-group">
                                        <div class="col-xs-8"></div>
                                        <div class="col-xs-4">
                                            <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            {{-- <div class="simple-footer">
                                Copyright &copy; Stisla 2018
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="assets/js/stisla.js"></script>

    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="assets/js/scripts.js"></script>
    <script src="assets/js/custom.js"></script>

    <!-- Page Specific JS File -->
</body>

</html>