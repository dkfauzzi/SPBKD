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
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars ms-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#ttg-sistupdos">Tentang SISTUPDOS</a></li>
                    <li class="nav-item"><a id="contactUs" class="nav-link" href="#">Contact Us</a></li>
                    @auth
                        @if(Session::get('userLevel') == 'dekan')
                        <li class="nav-item"><a class="nav-link" href="{{ URL::to('dekan-search') }}">Dashboard</a></li>
                        @elseif(Session::get('userLevel') == 'wakildekan1')
                            <li class="nav-item"><a class="nav-link" href="{{ URL::to('dekan-search') }}">Dashboard</a></li>
                        @elseif(Session::get('userLevel') == 'wakildekan2')
                            <li class="nav-item"><a class="nav-link" href="{{ URL::to('dekan-search') }}">Dashboard</a></li>
                        @elseif(Session::get('userLevel') == 'kaprodi')
                            <li class="nav-item"><a class="nav-link" href="{{ URL::to('dekan-search') }}">Dashboard</a></li>
                        @elseif(Session::get('userLevel') == 'ketuaKK')
                            <li class="nav-item"><a class="nav-link" href="{{ URL::to('dekan-search') }}">Dashboard</a></li>
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
                            <li><a class="dropdown-item" href="dekan-login">Dekanat</a></li>
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
            <a class="btn btn-primary btn-xl text-uppercase" href="#ttg-sistupdosr">Lihat SISTUPDOS</a>
        </div>
    </header>
    <!-- Services-->
    <section class="page-section" id="ttg-sistupdos">
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
                            <p class="text-muted">Sistem Informasi Tugas Penunjang DosenLorem ipsum dolor sit amet, consectetur adipiscing elit. 
                                Vestibulum pharetra luctus lacus, sit amet mollis neque efficitur quis. Nunc vel placerat nisi, 
                                eu sodales quam. Donec ac volutpat odio.  </p>
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
                            <p class="text-muted">Sistem Informasi Tugas Penunjang Dosen Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                                Vestibulum pharetra luctus lacus, sit amet mollis neque efficitur quis. Nunc vel placerat nisi, 
                                eu sodales quam. Donec ac volutpat odio.  </p>
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
                            <p class="text-muted">Sistem Informasi Tugas Penunjang Dosen Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                                Vestibulum pharetra luctus lacus, sit amet mollis neque efficitur quis. Nunc vel placerat nisi, 
                                eu sodales quam. Donec ac volutpat odio.  </p>
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
                            <p class="text-muted">Sistem Informasi Tugas Penunjang Dosen Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                                Vestibulum pharetra luctus lacus, sit amet mollis neque efficitur quis. Nunc vel placerat nisi, 
                                eu sodales quam. Donec ac volutpat odio. </p>
                        </div>
                    </div>
                </li>
            
            </ul>
        </div>
    </section>
    
    <!-- Contact-->

    <!-- Footer-->
    <footer class="footer py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 text-lg-start">Copyright &copy; Yasser 2023</div>
                <div class="col-lg-4 my-3 my-lg-0">
                   
                </div>
                <div class="col-lg-4 text-lg-end">
                   
                </div>
            </div>
        </div>
    </footer>


        <!-- Modal -->
    <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="contactModalLabel">Contact Information</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <p>Narahubung: Winarni Setyaningsih</p>
            <p>
                Nomor Telepon: 081808652880 </p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>
  
  
  

   <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Your custom scripts -->
<script src="assets_index/js/scripts.js"></script>
<script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>


    <!-- jQuery -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $('#contactUs').click(function() {
      $('#contactModal').modal('show');
    });
  });
</script>


</body>

</html>
