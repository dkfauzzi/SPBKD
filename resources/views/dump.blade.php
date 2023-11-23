<?


// app/Http/Controllers/UserController.php

public function create()
{
    return view('user.create');
}

$(document).ready(function () {
    // Display the table
    $('#table1').css('display', 'table');

    // DataTable initialization with options
    var table = $('#table1').DataTable({
        dom: '<"d-flex justify-content-center"f>', // Center the search box
        pageLength: -1, // Display all rows on a single page
        // Add other DataTable options as needed
    });

    // Click event on elements with the class "treeview"
    $(".treeview").click(function () {
        // Show or hide the DataTable row details based on your logic
        $('.media').collapse('show');

        // You may also need to redraw the DataTable if the content changes
        table.draw();
    });
});
