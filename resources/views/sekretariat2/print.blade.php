<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table class="table table-bordered" id="table1">
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
            <?php $no = 0?>
            @foreach ($data as $sk)
            <tr>    
                <td>{{1+$no++}}</td>
                <td class="text-center">{{$sk->sk}}</td>
                <td class="text-center">{{$sk->sks}}</td>
                {{-- <td>tEST</td> --}}
                {{-- <td class="text-center">{{$sk->q1_start_indonesian}} TEST {{$sk->q1_end_indonesian}}</td> --}}
                <td class="text-center">
                    {{$sk->jenis_sk}}
                </td>
                <td class="text-center">
                    {{$sk->keterangan_sk}}
                </td>
                <td class="text-center">
                    {{$sk->start_date ? Carbon\Carbon::parse($sk->start_date)->translatedFormat('d F Y', 'id') : ''}}
                <td class="text-center">
                    {{$sk->end_date ? Carbon\Carbon::parse($sk->end_date)->translatedFormat('d F Y', 'id') : ''}}
                    {{-- {{$sk->q2_start ? Carbon\Carbon::parse($sk->q2_start)->translatedFormat('d F Y', 'id') : ''}}  --}}
    
                </td>
                <td class="text-center">
                    {{$sk->start_sk}}
                </td>
                <td class="text-center">
                    {{$sk->end_sk}}
                </td>
                
                {{-- //Tombol Action --}}
                {{-- <td>
                    {{link_to('dashboard-koordinator-edit-kp/'.$kp->id,'Edit',['class'=>'btn btn-warning'])}}
                </td>
                <td>
                    {!! 
                    Form::open(['url'=>'dashboard-koordinator-kp/'.$kp->id,'method'=>'delete'])!!}
                    {!! Form::submit('Delete',['class'=>'btn
                    btn-danger','onclick'=>'return confirm("Are you sure?")'])!!}
                    {!! Form::close()!!}
                </td> --}}
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>