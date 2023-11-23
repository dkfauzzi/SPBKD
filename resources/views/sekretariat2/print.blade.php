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
    <table class="table table-bordered" >
        <thead style="border-color:black">
            <tr >
                <th class="text-center" style=" width:10px;">No</th>
                <th class="text-center" style="width:90px;">SK</th>
                <th class="text-center"style="width:90px; ">SKS</th>
                <th class="text-center"style="width:auto">Jenis SK</th>
                <th class="text-center"style="width:auto">Keterangan SK</th>
                <th class="text-center"style="width:auto">Tanggal Mulai</th>
                <th class="text-center"style="width:auto">Tanggal Berakhir</th>
                <th class="text-center" style="width:auto">Triwulan Dimulai</th>
                <th class="text-center"style="width:auto">Triwulan Berakhir</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1 @endphp
            @foreach ($quarterDate as $record)
            <tr>
                <td class="text-center">{{ $no++ }}</td>
                <td class="text-center">{{ $record->sks }}</td>
                <td class="text-center">{{ $record->sk }}</td>
                <td class="text-center">{{ $record->jenis_sk }}</td>
                <td class="text-center">{{ $record->keterangan_sk }}</td>
                <td class="text-center">{{ $record->start_date ? Carbon\Carbon::parse($record->start_date)->translatedFormat('d F Y', 'id') : '' }}</td>
                <td class="text-center">{{ $record->end_date ? Carbon\Carbon::parse($record->end_date)->translatedFormat('d F Y', 'id') : ''}}</td>
                <td class="text-center">{{ $record->start_sk }}</td>
                <td class="text-center">{{ $record->end_sk}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>