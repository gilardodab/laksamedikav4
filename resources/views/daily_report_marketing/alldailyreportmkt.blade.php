@extends('layouts.master')
@section('content')
@include('layouts.topNavBack')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <b class="card-title">Laporan Harian Marketing</b>
                            </div>                 
                        </div>
                    </div>
                    <div class="table-responsive">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {!! session('success') !!}
                            </div>
                        @endif
                        <table id="data_users_reguler" class="order-column" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>Marketing</th>
                                    <th>Update</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- DIRECTIVE FORELSE SAMA DENGAN FOREACH -->
                                <!-- HANYA SAJA SUDAH FORELSE SUDAH DILENGKAPI FUNGSI UNTUK MENGECEK DATA ADA ATAU TIDAK SEHINGGA KITA TIDAK PERLU LAGI MENGGUNAKAN IF CONDITION -->
                                <!-- JIKA DATA KOSONG MAKA FUNGSI YANG BERJALAN ADALAH CODE BERADA PADA BLOCK CODE @3MPTY -->
                                @forelse($dailyreportmkts as $dailyreportmkt)
                                <tr>
                                    <!-- MENAMPILKAN VALUE DARI TITLE -->
                                    <td>{{ $dailyreportmkt->customer }}</td>
                                    <td>{{ $dailyreportmkt->user->name }}</td>
                                    <td>{{ $dailyreportmkt->updated_at->format('d M Y')}}</td>  
                                    <!-- TOMBOL DELETE MENGGUNAKAN METHOD DELETE DALAM ROUTING SEHINGGA KITA MEMASUKKAN TOMBOL TERSEBUT KEDALAM TAG <FORM></FORM> -->
                                    <td>
                                        <form class="btn-group" action="{{ url('/daily-report-marketing/delete/' . $dailyreportmkt->id) }}" method="POST">
                                            <!-- @csrf ADALAH DIRECTIVE UNTUK MEN-GENERATE TOKEN CSRF -->
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE" class="form-control">
                                            <a href="{{ url('/daily-report-marketing/detail/' . $dailyreportmkt->id) }}" class="btn btn-warning btn-sm"><i class="mdi mdi-pencil"></i></a>
                                            <a href="{{ route('lihat.dailyreportmkt', $dailyreportmkt->id) }}" class="btn btn-primary btn-sm"><i class="mdi mdi-eye"></i></a>
                                            <a href="{{ route('print.dailyreportmkt', $dailyreportmkt->id) }}" class="btn btn-secondary btn-sm"><i class="mdi mdi-printer"></i></a>
                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini?')"><i class="mdi mdi-trash-can"></i></button>
                                        </form>
                                    </td>
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
    </div>
@endsection


 