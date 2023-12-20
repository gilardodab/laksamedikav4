<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Barang</title>
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
        <h3 align="right">LAPORAN BARANG</h3>
        <table>
            <thead>
                    <tr>
                        <td colspan="3" align="center"><b>Nama Barang</b></th>
                        <td colspan="1" align="center"><b>Stok</b></th>
                    </tr>
            </thead>
            <tbody>
                    @forelse($products as $product)
                     <tr>
                        <!-- MENAMPILKAN VALUE DARI TITLE -->
                        <td colspan="3">{{ $product->title }}</td>
                        <td colspan="1" align="center">{{ $product->stock }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td class="text-center" colspan="4">Empty Data</td>
                    </tr>
                    @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>