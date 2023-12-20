@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <b class="card-title">Daily Report Marketing</b>
                                <br><br>
                                <div class="card">
                                    <b style="font-size: 15px; color:green;">Customer : {{$dailyreportmkts->customer}}</b>
                                    <b style="font-size: 15px; color:green;">Marketing : {{$dailyreportmkts->user->name}}</b>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {!! session('success') !!}
                            </div>
                        @endif
                        <table class="table table-hover table-bordered">
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
                                <!-- DIRECTIVE FORELSE SAMA DENGAN FOREACH -->
                                <!-- HANYA SAJA SUDAH FORELSE SUDAH DILENGKAPI FUNGSI UNTUK MENGECEK DATA ADA ATAU TIDAK SEHINGGA KITA TIDAK PERLU LAGI MENGGUNAKAN IF CONDITION -->
                                <!-- JIKA DATA KOSONG MAKA FUNGSI YANG BERJALAN ADALAH CODE BERADA PADA BLOCK CODE @3MPTY -->
                                @forelse($details as $detail)
                                <tr>
                                    <!-- MENAMPILKAN VALUE DARI TITLE -->
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
                </div>
            </div>
        </div>
    </div>
@endsection

 