<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Sistem PKBD</title>
    <link rel="stylesheet" href="/css/bootstrap.css">
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets_index/assets/favicon.ico" />
    <!-- Fonts-->
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS -->
    <link href="assets_index/css/styles.css" rel="stylesheet" />
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img class="" src="assets_index/assets/img/Logo-fri-putih.png" alt="..." />
            </a>
            
            <!--DEFAULT UNTUK GAMBAR DI NAVBAR-->
            <!-- <img src="assets_index/assets/img/navbar-logo.svg" alt="..." /> -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars ms-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#skema-tugas-akhir">Tentang SISTUPDOS</a></li>
                    <li class="nav-item"><a class="nav-link" href="#langkah-sidang">Contact Us</a></li>
                    {{-- <li class="nav-item"><a class="nav-link" href="#poster-tugas-akhir">Poster Tugas Akhir</a></li> --}}
                    {{-- <li class="nav-item"><a class="nav-link" href="/Draft_Proposal_TA/sample.pdf"
                            target="_blank">Download</a></li> --}}
                    @auth
                        @if(Session::get('userLevel') == 'dekan')
                        <li class="nav-item"><a class="nav-link" href="{{ URL::to('dekan-dashboard') }}">Dashboard</a></li>
                        @elseif(Session::get('userLevel') == 'kaprodi')
                            <li class="nav-item"><a class="nav-link" href="{{ URL::to('prodi-dashboard') }}">Dashboard</a></li>
                        @elseif(Session::get('userLevel') == 'ketuaKK')
                            <li class="nav-item"><a class="nav-link" href="{{ URL::to('kk-dashboard') }}">Dashboard</a></li>
                        @elseif(Session::get('userLevel') == 'dosen')
                            <li class="nav-item"><a class="nav-link" href="{{ URL::to('dosen-dashboard') }}">Dashboard</a></li>
                        @elseif(Session::get('userLevel') == 'sekretariat2')
                            <li class="nav-item"><a class="nav-link" href="{{ URL::to('sekretariat2-search') }}">Dashboard</a></li>
                        @endif
                    
                        <li class="nav-item"><a class="nav-link" href="{{ URL::to('/logout') }}">Logout</a></li>
                    @else
                    <!-- Handle other cases if needed -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Login
                        </a>
    
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="dekan-login">Dekan</a></li>
                            <li><a class="dropdown-item" href="prodi-login">Ketua Program Studi</a></li>
                            <li><a class="dropdown-item" href="kk-login">Ketua Kelompok Keahlian</a></li>
                            <li><a class="dropdown-item" href="sekretariat2-login">Sekretariat</a></li>
                            <li><a class="dropdown-item" href="dosen-login">Dosen</a></li>
                        </ul>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Masthead-->
    <header class="masthead">
        <div class="container">
            <div class="masthead-subheading">Welcome To</div>
            <div class="masthead-heading text-uppercase">Sistem Informasi Tugas Penunjang Dosen</div>
            <a class="btn btn-primary btn-xl text-uppercase" href="#skema-tugas-akhir">Lihat SISTUPDOS</a>
        </div>
    </header>
    <!-- Services-->
    <section class="page-section" id="skema-tugas-akhir">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Tentang Sistem Informasi Tugas Penunjang Dosen</h2>
                <h3 class="section-subheading text-muted">Pelajari Sistem Informasi Tugas Penunjang Dosen</h3>
            </div>
            <ul class="timeline">
                <li>
                    <div class="timeline-image"><img class="rounded-circle img-fluid"
                            src="assets_index/assets/img/about/1.jpg" alt="..." /></div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h4>#1</h4>
                            <h4 class="subheading">Sistem Informasi Tugas Penunjang Dosen</h4>
                        </div>
                        <div class="timeline-body">
                            <p class="text-muted">Sistem Informasi Tugas Penunjang Dosen adalah adalah adalah 
                                adalah adalah adalah adalah adalah adalah adalah adalah adalah adalah 
                                adalah adalah adalah adalah adalah adalah adalah adalah adalah  </p>
                        </div>
                    </div>
                </li>
                <li class="timeline-inverted">
                    <div class="timeline-image"><img class="rounded-circle img-fluid"
                            src="assets_index/assets/img/about/2.jpg" alt="..." /></div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h4>#2</h4>
                            <h4 class="subheading">Sistem Informasi Tugas Penunjang Dosen</h4>
                        </div>
                        <div class="timeline-body">
                            <p class="text-muted">Sistem Informasi Tugas Penunjang Dosen adalah adalah adalah 
                                adalah adalah adalah adalah adalah adalah adalah adalah adalah adalah 
                                adalah adalah adalah adalah adalah adalah adalah adalah adalah  </p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="timeline-image"><img class="rounded-circle img-fluid"
                            src="assets_index/assets/img/about/3.jpg" alt="..." /></div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h4>#3</h4>
                            <h4 class="subheading">Sistem Informasi Tugas Penunjang Dosen</h4>
                        </div>
                        <div class="timeline-body">
                            <p class="text-muted">Sistem Informasi Tugas Penunjang Dosen adalah adalah adalah 
                                adalah adalah adalah adalah adalah adalah adalah adalah adalah adalah 
                                adalah adalah adalah adalah adalah adalah adalah adalah adalah  </p>
                        </div>
                    </div>
                </li>
                <li class="timeline-inverted">
                    <div class="timeline-image"><img class="rounded-circle img-fluid"
                            src="assets_index/assets/img/about/4.jpg" alt="..." /></div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h4>#4</h4>
                            <h4 class="subheading">Sistem Informasi Tugas Penunjang Dosen</h4>
                        </div>
                        <div class="timeline-body">
                            <p class="text-muted">Sistem Informasi Tugas Penunjang Dosen adalah adalah adalah 
                                adalah adalah adalah adalah adalah adalah adalah adalah adalah adalah 
                                adalah adalah adalah adalah adalah adalah adalah adalah adalah  </p>
                        </div>
                    </div>
                </li>
                <!-- <li class="timeline-inverted">
                        <div class="timeline-image">
                            <h4>
                                Good
                                <br />
                                Luck
                                <br />
                                !!
                            </h4>
                        </div>
                    </li> -->
            </ul>
        </div>
    </section>
    <!-- Langkah Sidang Grid-->
    {{-- <section class="page-section bg-light" id="langkah-sidang">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Langkah Sidang</h2>
                <h3 class="section-subheading text-muted">Klik Gambar-gambar Dibawah Untuk Melihat Detail Langkah
                    Setiap
                    kegiatan Sidang</h3>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-6 mb-4">
                    <!-- Langkah Sidang item 1-->
                    <div class="portfolio-item">
                        <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal1">
                            <div class="portfolio-hover">
                                <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="assets_index/assets/img/portfolio/sidang-proposal-ta-1.png"
                                alt="..." />
                        </a>
                        <div class="portfolio-caption">
                            <div class="portfolio-caption-heading">Sidang Proposal Tugas Akhir</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 mb-4">
                    <!-- Langkah Sidang item 2-->
                    <div class="portfolio-item">
                        <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal2">
                            <div class="portfolio-hover">
                                <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="assets_index/assets/img/portfolio/seminar-tugas-akhir-1.png"
                                alt="..." />
                        </a>
                        <div class="portfolio-caption">
                            <div class="portfolio-caption-heading">Seminar Tugas Akhir</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 mb-4">
                    <!-- Langkah Sidang item 3-->
                    <div class="portfolio-item">
                        <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal3">
                            <div class="portfolio-hover">
                                <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="assets_index/assets/img/portfolio/sidang-ta-1.png" alt="..." />
                        </a>
                        <div class="portfolio-caption">
                            <div class="portfolio-caption-heading">Sidang Tugas Akhir</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Poster Grid-->
    <section class="page-section bg-light" id="poster-tugas-akhir">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Poster Tugas Akhir</h2>
                <!-- <h3 class="section-subheading text-muted">Klik Gambar-gambar Dibawah Untuk Melihat Detail Langkah Setiap kegiatan Sidang</h3> -->
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-6 mb-4">
                    <!-- Poster item 1-->
                    <div class="portfolio-item">
                        <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal1">
                            <div class="portfolio-hover">
                                <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="assets_index/assets/img/portfolio/poster-ta-1.jpg" alt="..." />
                        </a>
                        <div class="portfolio-caption">
                            <div class="portfolio-caption-heading">Perbandingan Metode Diphone Concatenation Dan
                                Algoritma Sonic Pada Text-To-Speech</div>
                            <h3 class="section-subheading text-muted">Oleh Rd. Rakha Agung Trimanda</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 mb-4">
                    <!-- Poster item 2-->
                    <div class="portfolio-item">
                        <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal2">
                            <div class="portfolio-hover">
                                <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="assets_index/assets/img/portfolio/poster-ta-2.jpg" alt="..." />
                        </a>
                        <div class="portfolio-caption">
                            <div class="portfolio-caption-heading">Implementasi Optical Character Recognition Dengan
                                Metode Adaptive Classifier Untuk Konversi Gambar Ke Teks</div>
                            <h3 class="section-subheading text-muted">Oleh Aghnia Masni S.</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 mb-4">
                    <!-- Poster item 3-->
                    <div class="portfolio-item">
                        <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal3">
                            <div class="portfolio-hover">
                                <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="assets_index/assets/img/portfolio/poster-ta-3.jpg" alt="..." />
                        </a>
                        <div class="portfolio-caption">
                            <div class="portfolio-caption-heading">Pengujian Load Balancing Pada Cluster Server
                                Berbasis
                                Raspberry Pi</div>
                            <h3 class="section-subheading text-muted">Oleh Ridho Habi Putra</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- About-->
    <!-- <section class="page-section" id="about">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">About</h2>
                    <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                </div>
                <ul class="timeline">
                    <li>
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets_index/assets/img/about/1.jpg" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>2009-2011</h4>
                                <h4 class="subheading">Our Humble Beginnings</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p></div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets_index/assets/img/about/2.jpg" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>March 2011</h4>
                                <h4 class="subheading">An Agency is Born</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p></div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets_index/assets/img/about/3.jpg" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>December 2015</h4>
                                <h4 class="subheading">Transition to Full Service</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p></div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets_index/assets/img/about/4.jpg" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>July 2020</h4>
                                <h4 class="subheading">Phase Two Expansion</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p></div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image">
                            <h4>
                                Be Part
                                <br />
                                Of Our
                                <br />
                                Story!
                            </h4>
                        </div>
                    </li>
                </ul>
            </div>
        </section> -->
    <!-- Team-->
    <!-- <section class="page-section bg-light" id="team">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Our Amazing Team</h2>
                    <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="assets_index/assets/img/team/1.jpg" alt="..." />
                            <h4>Parveen Anand</h4>
                            <p class="text-muted">Lead Designer</p>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Parveen Anand Twitter Profile"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Parveen Anand Facebook Profile"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Parveen Anand LinkedIn Profile"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="assets_index/assets/img/team/2.jpg" alt="..." />
                            <h4>Diana Petersen</h4>
                            <p class="text-muted">Lead Marketer</p>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Diana Petersen Twitter Profile"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Diana Petersen Facebook Profile"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Diana Petersen LinkedIn Profile"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="assets_index/assets/img/team/3.jpg" alt="..." />
                            <h4>Larry Parker</h4>
                            <p class="text-muted">Lead Developer</p>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Larry Parker Twitter Profile"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Larry Parker Facebook Profile"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Larry Parker LinkedIn Profile"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 mx-auto text-center"><p class="large text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut eaque, laboriosam veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.</p></div>
                </div>
            </div>
        </section> -->
    <!-- Contact-->

    <!-- Footer-->
    <footer class="footer py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 text-lg-start">Copyright &copy; Yasser 2023</div>
                <div class="col-lg-4 my-3 my-lg-0">
                    <!-- <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a> -->
                </div>
                <div class="col-lg-4 text-lg-end">
                    <!-- <a class="link-dark text-decoration-none me-3" href="#!">Privacy Policy</a>
                        <a class="link-dark text-decoration-none" href="#!">Terms of Use</a> -->
                </div>
            </div>
        </div>
    </footer>
    <!-- Portfolio Modals-->
    <!-- Portfolio item 1 modal popup-->
    <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-bs-dismiss="modal"><img src="assets_index/assets/img/close-icon.svg"
                        alt="Close modal" /></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="modal-body">
                                <!-- Project details-->
                                <h2 class="text-uppercase">Sidang Proposal Tugas Akhir</h2>
                                <img class="img-fluid d-block mx-auto"
                                    src="assets_index/assets/img/portfolio/sidang-proposal-ta-1.png" alt="..." />
                                <p>1. Melakukan bimbingan dengan dospem</p>
                                <p>2. Mendapatkan rekomendasi untuk melaksanakan sidang proposal</p>
                                <p>3. Mengisi formulir pengajuan sidang judul</p>
                                <p>4. Melakukan konfirmasi kepada TU dan koordinator juka sudah melakukan pendaftaran
                                </p>
                                <p>5. Mahasiswa menunggu jadwal yang akan diberikan oleh Koordinator</p>
                                <p>6. Mahasiswa harus memberikan proposal tugas akhir minimal H-2 kepada para penguji
                                    dan pembimbing</p>
                                <p>7. Melaksanakan sidang judul</p>
                                <ul class="list-inline">
                                    <li>
                                        <strong>Syarat :</strong>
                                        Sudah lulus mata kuliah Metodologi Penelitian dan Riset
                                    </li>
                                    <li>
                                        *Mahasiswa wajib menyiapkan proposal TA
                                    </li>
                                </ul>
                                <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal"
                                    type="button">
                                    <i class="fas fa-xmark me-1"></i>
                                    Tutup Halaman
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Portfolio item 2 modal popup-->
    <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-bs-dismiss="modal"><img src="assets_index/assets/img/close-icon.svg"
                        alt="Close modal" /></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="modal-body">
                                <!-- Project details-->
                                <h2 class="text-uppercase">Seminar Tugas Akhir</h2>
                                <img class="img-fluid d-block mx-auto"
                                    src="assets_index/assets/img/portfolio/seminar-tugas-akhir-1.png" alt="..." />
                                <p>1. Melakukan bimbingan dengan dospem</p>
                                <p>2. Mendapatkan rekomendasi untuk melaksanakan seminar</p>
                                <p>3. Mengisi formulir pengajuan seminar</p>
                                <p>4. Melakukan konfirmasi kepada TU dan koordinator juka sudah melakukan pendaftaran
                                </p>
                                <p>5. Mahasiswa menunggu jadwal yang akan diberikan oleh Koordinator</p>
                                <p>6. Mahasiswa harus memberikan proposal tugas akhir minimal H-2 kepada para penguji
                                    dan pembimbing</p>
                                <p>7. Melaksanakan seminar di depan pembimbing, penguji, dan audience (mahasiswa)</p>
                                <ul class="list-inline">
                                    <li>
                                        <strong>Syarat :</strong>
                                        Progress TA sudah mencapai 80%
                                    </li>
                                    <li>
                                        *Mahasiswa wajib menyiapkan paper dan draf buku TA
                                    </li>
                                </ul>
                                <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal"
                                    type="button">
                                    <i class="fas fa-xmark me-1"></i>
                                    Tutup Halaman
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Portfolio item 3 modal popup-->
    <div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-bs-dismiss="modal"><img src="assets_index/assets/img/close-icon.svg"
                        alt="Close modal" /></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="modal-body">
                                <!-- Project details-->
                                <h2 class="text-uppercase">Sidang Tugas Akhir</h2>
                                <img class="img-fluid d-block mx-auto"
                                    src="assets_index/assets/img/portfolio/sidang-ta-1.png" alt="..." />
                                <p>1. Melakukan bimbingan dengan dospem</p>
                                <p>2. Mendapatkan rekomendasi untuk melaksanakan sidang akhir</p>
                                <p>3. Mengisi formulir pengajuan sidang akhir</p>
                                <p>4. Melakukan konfirmasi kepada TU dan koordinator juka sudah melakukan pendaftaran
                                </p>
                                <p>5. Mahasiswa menunggu jadwal yang akan diberikan oleh Koordinator</p>
                                <p>6. Mahasiswa harus memberikan proposal tugas akhir minimal H-2 kepada para penguji
                                    dan pembimbing</p>
                                <p>7. Melaksanakan sidang akhir</p>
                                <ul class="list-inline">
                                    <li>
                                        <strong>Syarat :</strong>
                                        Progress TA sudah mencapai 100%
                                    </li>
                                    <li>
                                        *Mahasiswa wajib menyiapkan buku TA
                                    </li>
                                </ul>
                                <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal"
                                    type="button">
                                    <i class="fas fa-xmark me-1"></i>
                                    Tutup Halaman
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Portfolio item 4 modal popup-->
    <div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-bs-dismiss="modal"><img src="assets_index/assets/img/close-icon.svg"
                        alt="Close modal" /></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="modal-body">
                                <!-- Project details-->
                                <h2 class="text-uppercase">Project Name</h2>
                                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                <img class="img-fluid d-block mx-auto" src="assets_index/assets/img/portfolio/4.jpg"
                                    alt="..." />
                                <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur
                                    adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt
                                    repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae,
                                    nostrum, reiciendis facere nemo!</p>
                                <ul class="list-inline">
                                    <li>
                                        <strong>Client:</strong>
                                        Lines
                                    </li>
                                    <li>
                                        <strong>Category:</strong>
                                        Branding
                                    </li>
                                </ul>
                                <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal"
                                    type="button">
                                    <i class="fas fa-xmark me-1"></i>
                                    Close Project
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Portfolio item 5 modal popup-->
    <div class="portfolio-modal modal fade" id="portfolioModal5" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-bs-dismiss="modal"><img src="assets_index/assets/img/close-icon.svg"
                        alt="Close modal" /></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="modal-body">
                                <!-- Project details-->
                                <h2 class="text-uppercase">Project Name</h2>
                                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                <img class="img-fluid d-block mx-auto" src="assets_index/assets/img/portfolio/5.jpg"
                                    alt="..." />
                                <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur
                                    adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt
                                    repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae,
                                    nostrum, reiciendis facere nemo!</p>
                                <ul class="list-inline">
                                    <li>
                                        <strong>Client:</strong>
                                        Southwest
                                    </li>
                                    <li>
                                        <strong>Category:</strong>
                                        Website Design
                                    </li>
                                </ul>
                                <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal"
                                    type="button">
                                    <i class="fas fa-xmark me-1"></i>
                                    Close Project
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Portfolio item 6 modal popup-->
    <div class="portfolio-modal modal fade" id="portfolioModal6" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-bs-dismiss="modal"><img src="assets_index/assets/img/close-icon.svg"
                        alt="Close modal" /></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="modal-body">
                                <!-- Project details-->
                                <h2 class="text-uppercase">Project Name</h2>
                                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                <img class="img-fluid d-block mx-auto" src="assets_index/assets/img/portfolio/6.jpg"
                                    alt="..." />
                                <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur
                                    adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt
                                    repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae,
                                    nostrum, reiciendis facere nemo!</p>
                                <ul class="list-inline">
                                    <li>
                                        <strong>Client:</strong>
                                        Window
                                    </li>
                                    <li>
                                        <strong>Category:</strong>
                                        Photography
                                    </li>
                                </ul>
                                <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal"
                                    type="button">
                                    <i class="fas fa-xmark me-1"></i>
                                    Close Project
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JS-->
    <script src="js/jqueryjs"></script>
    <script src="js/bootstrap.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="assets_index/js/scripts.js"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

</body>

</html>
