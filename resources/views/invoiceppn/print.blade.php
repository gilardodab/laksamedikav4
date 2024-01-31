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
            /*width:100px;*/
            width:auto;
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
        <table>
            <caption>
                 <!--<img align="left" src="{{ URL::asset('assets/images/logo_ptlmi.png')}}" width="150px" height="30px"><br>-->
                 <img align="left" src="{{ URL::asset('assets/images/logoptlmi.png')}}" width="185px" height="30px"><br>
                 
                 FAKTUR
            </caption>
            <thead>
                 <tr>
                    <td colspan="2" align="left">
                        <!--<h4>Dari</h4>-->
                        <p>PT Laksa Medika Internusa<br>
                           Pelem Lor No.50 Bantul Yogyakarta<br>
                        </p>
                    </td>
                    <td colspan="3">
                        <!--<h4>Untuk : </h4>-->
                        <p>{{ $invoiceppn->customer->name }}<br>
                        {{ $invoiceppn->customer->address }}<br>
                        {{ $invoiceppn->customer->phone }} <br>
                        {{ $invoiceppn->customer->email }}
                        </p>
                    </td>
                </tr>
                <tr>
                    <th colspan="1" align="left">Invoice <strong>#00{{ $invoiceppn->no_faktur_2023}}</strong></th>
                    <th colspan="2" align="center">Jatuh Tempo :{{ $invoiceppn->tenggat->format('D, d M Y')}}</th>
                    <th colspan="1" align="right">{{ $invoiceppn->created_at->format('D, d M Y') }}</th>
                    <th colspan="1">Marketing#{{ $invoiceppn->user->name }}</th>
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
                @foreach ($invoiceppn->detailppn as $row)
                <tr>
                    <td>{{ $row->product_detail->product->title }}</td>
                    <td align ="right">Rp {{ number_format($row->price) }}</td>
                    <td align ="center">{{ $row->qty }}</td>
                    <td align ="right">Rp {{ number_format($row->diskon) }}</td>
                    <td align ="right">Rp {{ $row->subtotal }}</td>
                </tr>
                @endforeach
                <tr>
                    <th colspan="4" align="left">Subtotal</th>
                    <td align ="right">Rp {{ number_format(floor($invoiceppn->total)) }}</td>
                </tr>
                <tr>
                    <th>Tax</th>
                    <td></td>
                    <td colspan="2">11%</td>
                    <td align ="right">Rp {{ number_format(floor($invoiceppn->tax)) }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4" align="left">Total Price</th>
                    <td align ="right">Rp {{ number_format(floor($invoiceppn->total_price)) }}</td>
                </tr>
                <tr>
                    <th colspan="2" align="center">Penerima</th>
                    <th colspan="3" align="center">Hormat Kami</th>
            </tr>
             <tr>
                    <td colspan="2" align="center"><br>(....................)</td>
                    <td colspan="3" align="center"><br>(Fatmawaty Aripin)</td>
            </tr>
            </tfoot>
        </table>
        <p align="right">
            Rekening BCA 037-479-6000<br>
            a.n PT LAKSA MEDIKA INTERNUSA
        </p>
    </div>


    <div class="page_break">
        <Table>
            <thead>
                <tr>
                    <th colspan="5">
                    <!--<img align="left" src="{{ URL::asset('assets/images/logo_ptlmi.png')}}" width="150px" height="30px">-->
                    <img align="left" src="{{ URL::asset('assets/images/logoptlmi.png')}}" width="185px" height="30px"><br>
                    <p align="right">
                        Pelem Lor No. 50 Baturetno, Banguntapan<br>
                        Bantul, DI. Yogyakarta. Telp/Fax +622742842046
                    </p>
                    <H1 align="center">TANDA TERIMA FAKTUR</H1><br>
                    <h3 align="left">Nama Outlet : {{ $invoiceppn->customer->name }} </h3>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th align ="center">No</th>
                    <th align ="center">No Faktur</th>
                    <th align ="center">Tanggal Faktur</th>
                    <th align ="center">Tanggal Jatuh Tempo</th>
                    <th align ="center">Jumlah</th>
                </tr>
                <?php $no=1;?>
                <tr>
                    <td align="center" scope="row">{{ $no }}</td>
                    <td align="center">00{{ $invoiceppn->no_faktur_2023}}</td>
                    <td align ="center">{{ $invoiceppn->created_at->format('D, d M Y') }}</td>
                    <td align ="center">{{ $invoiceppn->tenggat->format('D, d M Y')}}</td>
                    <td align ="right">Rp {{ number_format(floor($invoiceppn->total_price)) }}</td>
                </tr>
                <?php $no++ ;?>
                <tr>
                    <th colspan="4">Total Tagihan</th>
                    <td align ="right">Rp {{ number_format(floor($invoiceppn->total_price)) }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2" align="center">Penerima</th>
                    <td colspan="3" align="center">Yogyakarta, </td>
            </tr>
             <tr>
                    <td colspan="2" align="center"><br><br>(....................)</td>
                    <td colspan="3" align="center"><br><br>(Fatmawaty Aripin)</td>
            </tr>
            </tfoot>
        </Table>
    </div>

    <div class="page_break">
        <table>
            <tr>
                    <!--<img align="left" src="{{ URL::asset('assets/images/logo_ptlmi.png')}}" width="150px" height="30px">-->
                    <img align="left" src="{{ URL::asset('assets/images/logoptlmi.png')}}" width="185px" height="30px"><br>

                    <p align="right">
                        Pelem Lor No. 50 Baturetno, Banguntapan<br>
                        Bantul, DI. Yogyakarta. Telp/Fax +622742842046
                    </p>
                <h1 align="center">KWITANSI</h1>
                <p align="right" style="font-size: 14px; margin:5px">00{{ $invoiceppn->no_faktur_2023}}</p>
                <p align="left" style="font-size: 14px; margin:5px">Telah Terima Dari &nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;<b>{{ $invoiceppn->customer->name }}</b></p><hr align="right" width="80%">
                <p align="left" style="font-size: 14px; margin:5px;">Uang Sejumlah &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;<b>
                <?php 
                    function penyebut($nilai) {
                        $nilai = abs($nilai);
                        $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
                        $temp = "";
                        if ($nilai < 12) {
                            $temp = " ". $huruf[$nilai];
                        } else if ($nilai <20) {
                            $temp = penyebut($nilai - 10). " belas";
                        } else if ($nilai < 100) {
                            $temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
                        } else if ($nilai < 200) {
                            $temp = " seratus" . penyebut($nilai - 100);
                        } else if ($nilai < 1000) {
                            $temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
                        } else if ($nilai < 2000) {
                            $temp = " seribu" . penyebut($nilai - 1000);
                        } else if ($nilai < 1000000) {
                            $temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
                        } else if ($nilai < 1000000000) {
                            $temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
                        } else if ($nilai < 1000000000000) {
                            $temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
                        } else if ($nilai < 1000000000000000) {
                            $temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
                        }     
                        return $temp;
                    }
                 
                    function terbilang($nilai) {
                        if($nilai<0) {
                            $hasil = "minus ". trim(penyebut($nilai));
                        } else {
                            $hasil = trim(penyebut($nilai));
                        }     		
                        return $hasil;
                    }
                 
                 
                    $angka = ($invoiceppn->total_price);
                    echo terbilang ($angka)." rupiah";
                    ?>
                    </b></p><hr align="right" width="80%">
                    <p align="left" style="font-size: 14px; margin:5px">Guna Membayar &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;Pembayaran Faktur No. 00{{ $invoiceppn->no_faktur_2023 }}&nbsp;&nbsp;&nbsp;Tanggal Faktur {{ $invoiceppn->created_at->format('D, d M Y') }}</p><hr align="right" width="80%">
                    <p align="left" style="font-size: 14px; margin:5px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp;Tanggal Jatuh Tempo {{ $invoiceppn->tenggat->format('D, d M Y') }}</p><hr align="right" width="80%">
                    <p style="font-size: 14px; margin:14px;">Terbilang &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;
                        <span><b>Rp {{ number_format(floor($invoiceppn->total_price)) }}</b></span>
                    </p>
                    <p align="right" style="font-size: 14px; margin:5px; height:5%">
                        Yogyakarta,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>PT. Laksa Medika Internusa&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <!--{{ $invoiceppn->created_at->format('D, d M Y') }}-->
                    </p><br><br><br><br><br>
                    <p align="right" style="font-size: 14px; margin:5px;">
                        (Fatmawaty Aripin)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </p>
            </tr>
        </table>
    </div>
    
    <div class="page_break">
        <table>
            <thead>
            <tr>
            <th colspan="3">
                
                <!--<img align="left" src="{{ URL::asset('assets/images/logo_ptlmi.png')}}" width="150px" height="30px">-->
                <img align="left" src="{{ URL::asset('assets/images/logoptlmi.png')}}" width="185px" height="30px"><br>
                    <p align="right">
                        No. 00{{ $invoiceppn->no_faktur_2023}}/SJB/
                        <?php
                        $array_bulan = array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
                        $bulan = $array_bulan[date('n')];
                    
                        echo  "$bulan";
                    ?>
                        /{{ $invoiceppn->created_at->format('Y') }}/
                </p>
                <h1 align="center">SURAT JALAN BARANG</h1>
                <p align="left" style="font-size: 12px;">Telah Terima dari PT.Laksa Medika Internusa &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $invoiceppn->created_at->format('D, d M Y') }}</h3> 
            </th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <th align ="center">No</th>
                    <th align ="center">Nama Barang</th>
                    <th align ="center">Jumlah</th>
                </tr>
                @foreach ($invoiceppn->detailppn as $no=>$row)
                <tr>
                    <td align="center" scope="row">{{ $no+1 }}</td>
                    <td>{{ $row->product_detail->product->title }}</td>
                     <td align ="center">{{ $row->qty }}</td>
                </tr>
                @endforeach
                <tr>
                <td colspan="3">
                    <p align="left" style="font-size: 12px;"><b>Untuk&nbsp;&nbsp;&nbsp;: </b>{{ $invoiceppn->customer->name }} </h3> 
                    <p align="left" style="font-size: 12px;"><b>Alamat : </b>{{ $invoiceppn->customer->address }} </h3> 
                </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="1"align="center">Penerima</td>
                    <td colspan="2"align="center">PT.Laksa Medika Internusa<br>Admin Logistik</td>
                    {{-- {{ date('d F Y') }} --}}
            </tr>
             <tr>
                    <td colspan="1" align="center"><br><br>(....................)</td>
                    <td colspan="2" align="center"><br><br>(Puspita Tara Wahyuningsih)</td>
            </tr>
            </tfoot>
            
        </table>
    </div>
    
    <div class="page_break">
        <table>
            <thead>
            <tr>
            <th colspan="3">
                <h1 align="center">SURAT KELUAR BARANG GUDANG</h1>
                <p align="center" style="font-size: 12px;">No. 00{{ $invoiceppn->no_faktur_2023}}</p>
                <p align="right" style="font-size: 12px;">{{ $invoiceppn->created_at->format('D, d M Y') }}</h3> 
            </th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <th align ="center">No</th>
                    <th align ="center">Nama Barang</th>
                    <th align ="center">Jumlah</th>
                </tr>
                @foreach ($invoiceppn->detailppn as $e=>$row)
                <tr>
                    <td align="center" scope="row">{{ $e+1 }}</td>
                    <td>{{ $row->product_detail->product->title }}</td>
                     <td align ="center">{{ $row->qty }}</td>
                </tr>
                @endforeach
                <tr>
                <td colspan="3">
                    <p align="left" style="font-size: 12px;"><b>Untuk&nbsp;&nbsp;&nbsp;: </b>{{ $invoiceppn->customer->name }} </h3> 
                    <p align="left" style="font-size: 12px;"><b>Alamat : </b>{{ $invoiceppn->customer->address }} </h3> 
                </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="1"align="center">Penerima</td>
                    <td colspan="2"align="center">Yang Menyerahkan, </td>
                    {{-- {{ date('d F Y') }} --}}
            </tr>
             <tr>
                    <td colspan="1" align="center"><br><br>( Drajad Dwi Haryoko )</td>
                    <td colspan="2" align="center"><br><br>(Puspita Tara Wahyuningsih)</td>
            </tr>
            </tfoot>
            
        </table>
    </div>
</body>
</html>