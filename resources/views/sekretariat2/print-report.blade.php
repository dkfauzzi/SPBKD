<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report {{$year}}</title>

    <style>
        body, html {
        margin: 0;
        padding: 0;
        }
        
        body {
            background-image: url('assets_index/assets/img/footer-comp2.png');
            background-size: cover;  /* You can use 'contain' or other values based on your preference */
            background-repeat: no-repeat;
            background-position: center center; 
            /* margin: 0;
            padding: 0; */
        }

        .content {
            padding: 40px;
            color: 
        }

        .table2 {
            page-break-after: always;
        }
        
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .th, .td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        .th {
            background-color: ;
        }

        .logo{
            border: 1px solid #ddd;
            padding: ;
            text-align: center;
        }

        .row {
            display: flex;
        }

        .col {
            flex: 50%;
            padding: 10px;
        }

        .justify-content-center {
            text-align: center;
        }
    </style>
</head>
<body>
    
    
    
    <div class="content">

        <table class="table">
            <thead>
                <tr>
                    <th class=" "style="text-align: left;">
                        <img src="{{ $logoTelkom }}" alt="Logo" style="width: 130px">
                        
                    </th>
                    <th class=" "style="text-align: right;">
                        <img src="{{ $logoFakultas }}" alt="Logo" style="width: 205px">
                    </th>
                    </tr>
            </thead>
        </table>
        <div class="justify-content-center">
            <h2> <u>Report Tahunan Tugas Penunjang Dosen</u> </h2>
            <p style="font-size: 17px;">Tahun {{$year}}</p>

        </div>

        <h3>I. Kegiatan SK</h3>
        <table class="table">
            <thead class="th">
                <tr>
                    <th colspan="7">Tahun {{$year}}</th>
                </tr>

                <tr>
                    <th class="th">Kegiatan SK</th>
                    <th class="th">Jumlah SKS Semester 1</th>
                    <th class="th">Jumlah SKS Semester 2</th>
                    <th class="th" style="background-color: khaki">Total SKS</th>
                    <th class="th">Jumlah SK Semester 1</th>
                    <th class="th">Jumlah SK Semester 2</th>
                    <th class="th" style="background-color: khaki">Total SK</th>
                </tr>
            </thead>
            <tbody>
                @foreach($skData as $row)
                    <tr>
                        <td class="td">{{ $row['sk'] }}</td>
                        <td class="td">{{ $row['semester1_sks'] }}</td>
                        <td class="td">{{ $row['semester2_sks'] }}</td>
                        <td class="td" style="background-color: khaki">{{ $row['total_sks'] }}</td>
                        <td class="td">{{ $row['semester1_sk'] }}</td>
                        <td class="td">{{ $row['semester2_sk'] }}</td>
                        <td class="td" style="background-color: khaki">{{ $row['total_sk'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <h3>II. Program Studi</h3>
        <table class="table table2">
            <thead class="th">
                <tr>
                    <th colspan="7">Tahun {{$year}}</th>
                </tr>

                <tr>
                    <th class="th">Prodi</th>
                    <th class="th">Jumlah SKS Semester 1</th>
                    <th class="th">Jumlah SKS Semester 2</th>
                    <th class="th" style="background-color: khaki">Total SKS</th>
                    <th class="th">Jumlah SK Semester 1</th>
                    <th class="th">Jumlah SK Semester 2</th>
                    <th class="th" style="background-color: khaki">Total SK</th>
                </tr>
            </thead>
            <tbody>
                @foreach($prodiData as $row)
                    <tr>
                        <td class="td">{{ $row['Prodi'] }}</td>
                        <td class="td">{{ $row['semester1_sks'] }}</td>
                        <td class="td">{{ $row['semester2_sks'] }}</td>
                        <td class="td" style="background-color: khaki">{{ $row['total_sks'] }}</td>
                        <td class="td">{{ $row['semester1_sk'] }}</td>
                        <td class="td">{{ $row['semester2_sk'] }}</td>
                        <td class="td" style="background-color: khaki">{{ $row['total_sk'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h3>III. Kelompok Keahlian</h3>
        <table class="table">
            <thead class="th">
                <tr>
                    <th colspan="7">Tahun {{$year}}</th>
                </tr>
                <tr>
                    <th class="th">Kelompok Keahlian</th>
                    <th class="th">Jumlah SKS Semester 1</th>
                    <th class="th">Jumlah SKS Semester 2</th>
                    <th class="th" style="background-color: khaki">Total SKS</th>
                    <th class="th">Jumlah SK Semester 1</th>
                    <th class="th">Jumlah SK Semester 2</th>
                    <th class="th" style="background-color: khaki">Total SK</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kkData as $row)
                    <tr >
                        <td class="td">{{ $row['KK'] }}</td>
                        <td class="td">{{ $row['semester1_sks'] }}</td>
                        <td class="td">{{ $row['semester2_sks'] }}</td>
                        <td class="td" style="background-color: khaki">{{ $row['total_sks'] }}</td>
                        <td class="td">{{ $row['semester1_sk'] }}</td>
                        <td class="td">{{ $row['semester2_sk'] }}</td>
                        <td class="td" style="background-color: khaki">{{ $row['total_sk'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <h3>IV. Dosen</h3>
        <table class="table">
            <thead class="th">
                <tr>
                    <th colspan="8">Tahun {{$year}}</th>
                </tr>
                <tr>
                    <th class="th">NIP</th>
                    <th class="th">Nama</th>
                    <th class="th">Jumlah SKS Semester 1</th>
                    <th class="th">Jumlah SKS Semester 2</th>
                    <th class="th" style="background-color: khaki">Total SKS</th>
                    <th class="th">Jumlah SK Semester 1</th>
                    <th class="th">Jumlah SK Semester 2</th>
                    <th class="th" style="background-color: khaki">Total SK</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dosenData as $row)
                    <tr>
                        <td class="td">{{ $row['NIP'] }}</td>
                        <td class="td">{{ $row['nama'] }}</td>
                        <td class="td">{{ $row['semester1_sks'] }}</td>
                        <td class="td">{{ $row['semester2_sks'] }}</td>
                        <td class="td" style="background-color: khaki">{{ $row['total_sks'] }}</td>
                        <td class="td">{{ $row['semester1_sk'] }}</td>
                        <td class="td">{{ $row['semester2_sk'] }}</td>
                        <td class="td" style="background-color: khaki">{{ $row['total_sk'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    
    
    
</body>
</html>