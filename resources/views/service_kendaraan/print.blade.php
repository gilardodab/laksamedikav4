<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pengajuan - Service Kendaraan</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body{
            font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            color:#333;
            text-align:left;
            font-size:12px;
            margin:0;
        }
        .container{
            margin:0 auto;
            margin-top:0px;
            padding:0px;
            width:700px;
            height:auto;
            background-color:#fff;
        }
        caption{
            font-size:15px;
            margin-bottom:5px;
            text-align:right;
        }
        table{
            border:1px solid #333;
            border-collapse:collapse;
            margin:0 auto;
            width:700px;
        }
        td, tr, th{
            padding:5px;
            border:1px solid #333;
            width:100px;
        }
        th{
            background-color: #fff;
        }
        h4, p{
            margin:0px;
        }
        
        .page_break { page-break-before: always; }
    </style>
</head>
<body>
    <div class="container">
        <img align="left" src="{{ URL::asset('assets/images/logo_ptlmi.png')}}" width="150px" height="30px"><br>
        <h3 align="right">PENGAJUAN SERVICE KENDARAAN</h3>
        <H4>Nama Pemakai &nbsp;: {{$servicekendaraans->nama}}</H4>
        <H4>Nama Kendaraan &nbsp;: {{$servicekendaraans->merk_mobil}}</H4><br>
        <table>
            <thead>
                    <tr>
                        <td align="center"><b>No</b></td>
                        <td align="center"><b>Jenis Service</b></th>
                        <td align="center"><b>Biaya Service</b></th>
                    </tr>
            </thead>
            <tbody>
                @foreach ($details as $no=>$row)
                <tr>
                    <td align="center" scope="row">{{ $no+1 }}</td>
                    <td align ="left">{{ $row->service }}</td>
                    <td align ="right">Rp {{ number_format($row->harga) }}</td>
                </tr>                
                @endforeach                
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2"><b>Total</b></td>
                    <td align="right"><b>Rp {{ number_format($details->sum('harga')) }}</b></th>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>