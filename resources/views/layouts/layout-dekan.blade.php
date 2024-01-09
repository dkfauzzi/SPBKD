<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Dashboard Dekan</title>
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

    <!-- CHARTS-->

    <!-- Include Chart.js datalabels plugin -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        #table1_wrapper .dataTables_filter input {
            border: 1px solid #28a745; /* Change the border color to green */
        }

        /* Add this style to your CSS or in a style tag in your HTML */
        .dropdown {
            position: relative;
        }

        .dropdown-menu {
            position: absolute;
            z-index: 100000; /* Set a higher z-index value */
        }

        .custom-dropdown .dropdown-item:hover {
        background-color: #28a745; /* Replace with your desired color */
        }

        .custom-dropdown .dropdown-item:hover {
        background-color: #39dd5f; /* Replace with your desired hover color */
        }


    </style>


</head>
    
<body>
    <div class="container-fluid">
        @yield('content')
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    @stack('scripts')

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
<script>
    $(document).ready(function() {
        // Initialize DataTable with options
        $('#table2').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]], // Set the available options
            "pageLength": 10, // Set the initial value for the page length
        });
    });
</script>

    <!-- Additional scripts -->
    <script src="/assets/js/scripts.js"></script>
    <script src="/assets/js/custom.js"></script>
</body>
</html>
