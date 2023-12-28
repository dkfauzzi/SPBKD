<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login - Sekretariat</title>
    <style>
        body {
            background-image: url("assest_index/assets/img/TULT-hijau.jpg");
            
        }
    </style>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->
    <!-- <link rel="stylesheet" href="../node_modules/bootstrap-social/bootstrap-social.css"> -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">
</head>

<body style="background-image: url('assets_index/assets/img/TULT-hijau.jpg'); background-size: cover;">
    <div id="">
        <section class="section">
            <div class="container mt-5" >
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="login-brand">
                            <a href="/"><img src="assets_index/assets/img/logo-fri-putih.png" alt="logo" width="300"></a>
                        </div>

                        <div class="card card-primary ">
                            <div class="card-header">
                                <h4>Login Sekretariat</h4>
                            </div>
                            <div class="card-body">
                                <!-- Display error messages -->
                                @if($errors->any() || session('warning'))
                                    <div class="alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        @if(session('warning'))
                                            <div class="alert alert-warning">
                                                {{ session('warning') }}
                                            </div>
                                        @endif
                                    </div>
                                @endif
                                <!--FORM-->
                                <form action="post-login-sekretariat2" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="NIP">Username</label>
                                        <input id="NIP" type="NIP" class="form-control" name="NIP" tabindex="1" required autofocus>
                                        <div class="invalid-feedback">
                                            Please fill in your NIP
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
                                    <div class="row-group">
                                        <div class="col-xs-8"></div>
                                        <div class="col-xs-4">
                                            <button type="submit" name="login" class="btn btn-primary btn-block btn-flat">Sign In</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                             <!-- Register -->
                            <div class=" mb-3 text-muted text-center">
                                <a href="/">Home</a>
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