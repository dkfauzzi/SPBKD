<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Dashboard Dekan</title>
    <link rel="icon" href="assets_index/assets/img/logo-fri-putih-2.png">

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

    <script src="{{asset('https://rawgit.com/sitepoint-editors/jsqrcode/master/src/qr_packed.js')}}"></script>

    <link rel="stylesheet" href="//cdn.jsdelivr.net/jquery.ui.timepicker.addon/1.4.5/jquery-ui-timepicker-addon.min.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
    
<body>
    <div class="container-fluid">

        @yield('content')

        <!-- General JS Scripts -->
        <script src="/assets/modules/jquery.min.js"></script>
        <script src="/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
        <script src="/assets/modules/datatables/datatables.min.js"></script>
        <script src="/assets/modules/popper/popper.min.js"></script>
        <script src="/assets/modules/bootstrap/js/bootstrap.min.js"></script>

        <script src="/assets/modules/moment.min.js"></script>
        <script src="/assets/js/stisla.js"></script>


        <!-- JS Libraies -->
        <script src="/assets/modules/sweetalert2/sweetalert2.min.js"></script>
        <script src="/assets/modules/summernote/summernote-bs4.js"></script>

        <script>
            $('#table1').css('display', 'table');
            $('#table1').DataTable();

            $(".treeview").click(function() {
                $('.media').collapse('show');
            });
            
        </script>

        <script>
            $('#table2').css('display', 'table');
            $('#table2').DataTable();

            $(".treeview").click(function() {
                $('.media').collapse('show');
            });
        </script>
        <script>
            $('#table3').css('display', 'table');
            $('#table3').DataTable(
                paging: false,
                ordering: false,
                info: false,
            );

            $(".treeview").click(function () {
                $('.media').collapse('show');
            });

        </script>

        <script>
            $('#table4').css('display', 'table');
            $('#table4').DataTable(
                paging: false,
                ordering: false,
                info: false,
            );

            $(".treeview").click(function () {
                $('.media').collapse('show');
            });

        </script>

        <script>
            var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October",
                "November", "December"
            ];
            var n = new Date();
            var y = n.getFullYear();
            var m = n.getMonth();
            var d = n.getDate();
            document.getElementById("date").innerHTML = d + " " + months[m] + " " + y;
        </script>

        <!-- Template JS File -->
        <script src="/assets/js/scripts.js"></script>
        <script src="/assets/js/custom.js"></script>
        <script src="/js/qr-code-scanner.js"></script>

        <script>
            $(function() {
              $('#timepicker').timepicker();
            });
            </script>

        <script src="//cdn.jsdelivr.net/jquery.ui.timepicker.addon/1.4.5/jquery-ui-timepicker-addon.min.js"></script>
    </div>
</body>
</html>
