<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
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
            width:auto;
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
                 <!--<img align="left" src="{{ URL::asset('img/portfolio/logo_ptlmi.png')}}" width="150px" height="30px"><br>-->
                 FAKTUR
            </caption>
            <thead>
                 <tr>
                    <td colspan="1" align="left">
                        <!--<h4>Dari</h4>-->
                        <!--<p>PT Laksa Medika Internusa<br>-->
                        <!--   Pelem Lor No.50 Bantul Yogyakarta<br>-->
                        <!--</p>-->
                    </td>
                    <td colspan="4">
                        <!--<h4>Untuk : </h4>-->
                        <p>{{ $invoice->customer->name }}<br>
                        {{ $invoice->customer->address }}<br>
                        {{ $invoice->customer->phone }} <br>
                        {{ $invoice->customer->email }}
                        </p>
                    </td>
                </tr>
                <tr>
                    <th colspan="1">Invoice <strong>#{{ $invoice->id}}</strong></th>
                    <th colspan="2" align="center">Jatuh Tempo :{{ $invoice->tenggat}}</th>
                    <th colspan="1" align="right">{{ $invoice->created_at->format('D, d M Y') }}</th>
                    <th colspan="1">Marketing#{{ $invoice->user->name }}</th>
                </tr>
            </thead>
                    </table><br>
        <table>
            <tbody>
                <tr>
                    <th align ="center">Product</th>
                    <th align ="center">Price</th>
                    <th align ="center">Qty</th>
                    <th align ="center">Diskon</th>
                    <th align ="center">Subtotal</th>
                </tr>
                @foreach ($invoice->detail as $row)
                <tr>
                    <td>{{ $row->product_detail->product->title }}</td>
                    <td align ="right">Rp {{ number_format($row->price) }}</td>
                    <td align ="center">{{ $row->qty }}</td>
                    <td align ="right">Rp {{ number_format($row->diskon) }}</td>
                    <td align ="right">Rp {{ $row->subtotal }}</td>
                </tr>
                @endforeach
                <tr>
                    <th colspan="4">Subtotal</th>
                    <td align ="right">Rp {{ number_format($invoice->total) }}</td>
                </tr>
                <tr>
                    <th>Tax</th>
                    <td></td>
                    <td colspan="2">10%</td>
                    <td align ="right">Rp {{ number_format($invoice->total*10/100) }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4">Total Price</th>
                    <td align ="right">Rp {{ number_format($invoice->total_price+($invoice->total*10/100)) }}</td>
                </tr>
                <tr>
                    <th colspan="2" align="center">Penerima</th>
                    <th colspan="3" align="center">Hormat Kami</th>
            </tr>
             <tr>
                    <td colspan="2" align="center"><br><br>(....................)</td>
                    <td colspan="3" align="center"><br><br>(Fatma WA)</td>
            </tr>
            </tfoot>
        </table>
        <p align="right">
            Rekening BCA 0373316897<br>
            a.n Fatmawaty Aripin
        </p>
    </div>
</body>
</html>

