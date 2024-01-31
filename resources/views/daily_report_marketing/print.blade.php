<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daily Report</title>
    <style>
        body {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            color: #333;
            text-align: left;
            font-size: 12px;
            margin: 0;
        }

        .container {
            margin: 0 auto;
            margin-top: 0px;
            padding: 0px;
            width: 700px;
            height: auto;
            background-color: #fff;
        }

        caption {
            font-size: 15px;
            margin-bottom: 5px;
            text-align: right;
        }

        table {
            border: 1px solid #333;
            border-collapse: collapse;
            margin: 0 auto;
            width: 700px;
        }

        td, tr, th {
            padding: 5px;
            border: 1px solid #333;
            width: 100px;
        }

        th {
            background-color: #fff;
        }

        h4, p {
            margin: 0px;
        }

        .page_break {
            page-break-before: always;
        }
    </style>
</head>
<body>
    <div class="container">
        <img align="left" src="{{ URL::asset('assets/images/logo_ptlmi.png')}}" width="150px" height="30px">
        <h3 align="right">DAILY REPORT MARKETING</h3>
        <h4>Customer: {{$dailyreportmkts->customer}}</h4>
        <h4>Marketing: {{$dailyreportmkts->user->name}}</h4>

        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Tujuan</th>
                    <th>Petugas</th>
                    <th>No HP</th>
                    <th>Produk</th>
                    <th>Penjelasan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($details as $detail)
                    <tr>
                        <td>{{$detail->tanggal->format('D, d M Y')}}</td>
                        <td>{{$detail->tujuan}}</td>
                        <td>{{$detail->petugas}}</td>
                        <td>{{$detail->no_hp}}</td>
                        <td>{{$detail->produk}}</td>
                        <td>{{$detail->penjelasan}}</td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="6">Empty Data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>
