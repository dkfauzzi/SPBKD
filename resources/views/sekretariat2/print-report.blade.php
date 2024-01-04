<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report {{$year}}</title>

    <style>
        /* Add your styles here */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .row {
            display: flex;
        }

        .col {
            flex: 50%;
            padding: 10px;
        }
    </style>
</head>
<body>

    <table>
        <thead>
            <tr>
                <th>Prodi<img src="{{ asset('assets_index/assets/img/logo-fri-hijau.png') }}" alt="Logo">
                </th>
                <th>Jumlah SKS Semester 1</th>
                </tr>
        </thead>
    </table>
    
    <div class="container">
        
        <div class="row">
            <div class="col">
                <h1>logo TekU</h1>
            </div>
            <div class="col">
                <h1>logo TekU</h1>
            </div>
        </div>
        
        <h2>PROGRAM STUDI</h2>

        <table>
            <thead>
                <tr>
                    <th colspan="7">Tahun {{$year}}</th>
                </tr>

                <tr>
                    <th>Prodi</th>
                    <th>Jumlah SKS Semester 1</th>
                    <th>Jumlah SKS Semester 2</th>
                    <th style="background-color: khaki">Total SKS</th>
                    <th>Jumlah SK Semester 1</th>
                    <th>Jumlah SK Semester 2</th>
                    <th style="background-color: khaki">Total SK</th>
                </tr>
            </thead>
            <tbody>
                @foreach($prodiData as $row)
                    <tr>
                        <td>{{ $row['Prodi'] }}</td>
                        <td>{{ $row['semester1_sks'] }}</td>
                        <td>{{ $row['semester2_sks'] }}</td>
                        <td style="background-color: khaki">{{ $row['total_sks'] }}</td>
                        <td>{{ $row['semester1_sk'] }}</td>
                        <td>{{ $row['semester2_sk'] }}</td>
                        <td style="background-color: khaki">{{ $row['total_sk'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h2>KELOMPOK KEAHLIAN</h2>


        <table>
            <thead>
                <tr>
                    <th colspan="7">Tahun {{$year}}</th>
                </tr>
                <tr>
                    <th>Kelompok Keahlian</th>
                    <th>Jumlah SKS Semester 1</th>
                    <th>Jumlah SKS Semester 2</th>
                    <th style="background-color: khaki">Total SKS</th>
                    <th>Jumlah SK Semester 1</th>
                    <th>Jumlah SK Semester 2</th>
                    <th style="background-color: khaki">Total SK</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kkData as $row)
                    <tr>
                        <td>{{ $row['KK'] }}</td>
                        <td>{{ $row['semester1_sks'] }}</td>
                        <td>{{ $row['semester2_sks'] }}</td>
                        <td style="background-color: khaki">{{ $row['total_sks'] }}</td>
                        <td>{{ $row['semester1_sk'] }}</td>
                        <td>{{ $row['semester2_sk'] }}</td>
                        <td style="background-color: khaki">{{ $row['total_sk'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <h2>DOSEN</h2>

        <table>
            <thead>
                <tr>
                    <th colspan="8">Tahun {{$year}}</th>
                </tr>
                <tr>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Jumlah SKS Semester 1</th>
                    <th>Jumlah SKS Semester 2</th>
                    <th style="background-color: khaki">Total SKS</th>
                    <th>Jumlah SK Semester 1</th>
                    <th>Jumlah SK Semester 2</th>
                    <th style="background-color: khaki">Total SK</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dosenData as $row)
                    <tr>
                        <td>{{ $row['NIP'] }}</td>
                        <td>{{ $row['nama'] }}</td>
                        <td>{{ $row['semester1_sks'] }}</td>
                        <td>{{ $row['semester2_sks'] }}</td>
                        <td style="background-color: khaki">{{ $row['total_sks'] }}</td>
                        <td>{{ $row['semester1_sk'] }}</td>
                        <td>{{ $row['semester2_sk'] }}</td>
                        <td style="background-color: khaki">{{ $row['total_sk'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    
    
    
</body>
</html>