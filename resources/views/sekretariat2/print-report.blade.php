<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

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
    </style>
</head>
<body>
    
    {{-- <table>
        
        <thead>
            <tr>
                <th colspan="5">SKS Tahun 2019</th>
            </tr>
            <tr>
                <th>NIP</th>
                <th>Nama</th>
                <th>Jumlah SKS Semester 1</th>
                <th>Jumlah SKS Semester 2</th>
                <th>Total SKS</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reportData->groupBy('NIP') as $NIP => $rows)
                @php
                    $totalSemester1 = $rows->where('semester', 'semester1')->sum('total_sks');
                    $totalSemester2 = $rows->where('semester', 'semester2')->sum('total_sks');
                    $totalBothSemesters = $totalSemester1 + $totalSemester2;
                @endphp
    
                <tr>
                    <td>{{ $NIP }}</td>
                    <td>{{ $rows->first()['nama'] }}</td>
                    <td>{{ $totalSemester1 }}</td>
                    <td>{{ $totalSemester2 }}</td>
                    <td>{{ $totalBothSemesters }}</td>
                </tr>
            @endforeach
        </tbody>
        
        <thead>
            <tr>
                <th colspan="5">SK Tahun 2019</th>
            </tr>
            <tr>
                <th>NIP</th>
                <th>Nama</th>
                <th>Jumlah SK Semester 1</th>
                <th>Jumlah SK Semester 2</th>
                <th>Total SK</th>
            </tr>
        </thead>
        <tbody>
            @foreach($skReportData as $skRow)
                <tr>
                    <td>{{ $skRow['NIP'] }}</td>
                    <td>{{ $skRow['nama'] }}</td>
                    <td>{{ $skRow['semester1'] }}</td>
                    <td>{{ $skRow['semester2'] }}</td>
                    <td>{{ $skRow['total_sk'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table> --}}
    
    <h2>PROGRAM STUDI</h2>

    <table>
        <thead>
            <tr>
                <th colspan="3">Tahun {{$year}}</th>
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
                <th colspan="3">Tahun {{$year}}</th>
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
                <th colspan="4">Tahun {{$year}}</th>
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
    
    
</body>
</html>