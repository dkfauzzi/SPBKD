<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Register - Dekan</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/modules/fontawesome/css/all.min.css') }}">

    <!-- CSS Libraries -->
    <!-- <link rel="stylesheet" href="../node_modules/bootstrap-social/bootstrap-social.css"> -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/components.css') }}">
    <link rel="stylesheet" href="assets_index/assets/css/style.css">
    <link rel="stylesheet" href="assets_index/assets/css/components.css">
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
                                <h4>Register Dekan</h4>
                            </div>
                            <div class="card-body">
                                <form action="post-login-dekan" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="username">Nama</label>
                                        <input id="username" type="username" class="form-control" name="username" tabindex="1" required autofocus>
                                        <div class="invalid-feedback">
                                            Please fill in your email
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input id="username" type="username" class="form-control" name="username" tabindex="1" required autofocus>
                                        <div class="invalid-feedback">
                                            Please fill in your email
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="username">Email</label>
                                        <input id="username" type="username" class="form-control" name="username" tabindex="1" required autofocus>
                                        <div class="invalid-feedback">
                                            Please fill in your email
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password" class="control-label">Password</label>
                                        </div>
                                        <input id="password" type="password" class="form-control" name="password" tabindex="2" required autofocus>
                                        <div class="invalid-feedback">
                                            please fill in your password
                                        </div>
                                    </div>

                                    <!-- <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                      <label class="custom-control-label" for="remember-me">Remember Me</label>
                    </div>
                  </div> -->

                                    <div class="row-group">
                                        <div class="col-xs-8"></div>
                                        <div class="col-xs-4">
                                            <button type="submit" name="login" class="btn btn-primary btn-block btn-flat">Register</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                             <!-- Register -->
                            <div class=" mb-3 text-muted text-center">
                                Don't have an account? <a href="auth-register.html">Register!</a>
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