<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Dashboard Sekretariat</title>
    <link rel="icon" href="assets_index/assets/img/logo-fri-putih-2.png">

    
    
    <!-- General CSS Files -->
    <link rel="stylesheet" href="/assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/modules/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/modules/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="/css/bootstrap.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="/assets/modules/datatables/datatables.min.css">
    <link rel="stylesheet" href="/assets/modules/sweetalert2/sweetalert2.scss">
    <link rel="stylesheet" href="/assets/modules/summernote/summernote-bs4.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/components.css">


    <link rel="stylesheet" href="//cdn.jsdelivr.net/jquery.ui.timepicker.addon/1.4.5/jquery-ui-timepicker-addon.min.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- CHARTS-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Include Chart.js datalabels plugin -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

    <style>
        #table1_wrapper .dataTables_filter input {
            border: 1px solid #28a745; /* Change the border color to green */
        }

    </style>


</head>
    
<body>
    <div class="container-fluid">
        @yield('content')
    </div>

    <!-- General JS Scripts -->
    {{-- <script src="/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="/assets/modules/datatables/datatables.min.js"></script>
    <script src="/assets/modules/popper/popper.min.js"></script>
    <script src="/assets/modules/bootstrap/js/bootstrap.min.js"></script> --}}

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- DataTables scripts -->
    <script src="/assets/modules/datatables/datatables.min.js"></script>

    <!-- stisla.js -->
    <script src="/assets/js/stisla.js"></script>
    
   <script>
        $(document).ready(function () {
            $('#table1').css('display', 'table');
            $('#table1').DataTable({
                "pageLength": -1,  // Display all rows on a single page
                "dom": '<"d-flex justify-content-center"f>t',
            });

            $(".treeview").click(function() {
                $('.media').collapse('show');
            });
        });

</script>

    <!-- Additional scripts -->
    <script src="/assets/js/scripts.js"></script>
    <script src="/assets/js/custom.js"></script>
</body>
</html>
