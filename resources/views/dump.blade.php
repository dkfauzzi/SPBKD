<?


<div class="col">
    <h4>Download Excel</h4>
    <div class="dropdown">
        <button class="btn btn-success dropdown-toggle" type="button" id="yearExcel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Pilih Tahun
        </button>
        <div class="dropdown-menu custom-dropdown" aria-labelledby="yearExcel">
            @foreach($distinctYears as $year)
                <a class="dropdown-item" href="{{ url('export-excel/' . $year) }}">Tahun {{ $year }} (Excel)</a>
            @endforeach
        </div>
    </div>
</div>


// Ensure the document is ready before attaching event handlers
$(document).ready(function() {
    $('#yearExcel').on('click', function(e) {
        // Prevent the default action of the button
        e.preventDefault();

        // Toggle the dropdown menu
        $(this).toggleClass('show');

        // Get the dropdown menu associated with the button
        var dropdownMenu = $(this).next('.dropdown-menu');

        // Toggle the visibility of the dropdown menu
        dropdownMenu.toggleClass('show');
    });
});
