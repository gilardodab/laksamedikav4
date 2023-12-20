<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Penjualan PPN</title>
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
        
    </style>
</head>
<body>
    <div class="container">
        <table>
            <caption>
                <img align="left" src="{{ URL::asset('assets/images/logo_ptlmi.png')}}" width="150px" height="30px"><br>
                <b align="center">LAPORAN PENJUALAN PPN</b>
                <p style="font-size:10;">{{ Carbon\Carbon::parse($darippn)->isoFormat('D MMMM Y') }} - {{ Carbon\Carbon::parse($sampaippn)->isoFormat('D MMMM Y')}}</p>
            </caption>
            <thead>
                <tr>
                    <th colspan="1">No Invoice</strong></th>
                    <th colspan="2">Customer</th>
                    <th colspan="2">Total Price</th>
                </tr>
            </thead>
            <tbody>
                @php $ppn = 0;
                @endphp
                @foreach ($invoiceppns as $inv)
                <tr>
                    <td colspan="1">{{ $inv->id }}</td>
                    <td colspan="2">{{ $inv->customer->name }}</td>
                    <td colspan="2" align="right">Rp. {{ number_format($inv->total) }}</td>
                </tr>
                @php $ppn += $inv->total_price;
                @endphp
                @endforeach
            </tbody>
            <tfoot>
             <tr>
                    <td colspan="1"></td>
                    <td colspan="2"><b>Total</b></td>
                    <td colspan="2" align="right"><b>Rp. {{ number_format($ppn) }}</b></td>
             </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>































