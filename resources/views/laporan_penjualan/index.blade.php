@extends('layouts.master')
@section('content')
@include('layouts.topNavBack')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <b class="card-title">Laporan Penjualan NON PPN</b>
                    </div>
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{ url('/cari') }}" method="get">
                            @csrf
                            <div class="form-group">
                                <label for="">Dari</label>
                                <input type="date" name="dari" class="form-control datepicker" placeholder="Tanggal">
                            </div>
                            <div class="form-group">
                                <label for="">Sampai</label>
                                <input type="date" name="sampai" class="form-control datepicker" placeholder="Tanggal">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-danger btn-sm"><span class="mdi mdi-printer"> Cetak</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <b class="card-title">Laporan Penjualan PPN</b>
                    </div>
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{ url('/carippn') }}" method="get">
                            @csrf
                            <div class="form-group">
                                <label for="">Dari</label>
                                <input type="date" name="darippn" class="form-control datepicker" placeholder="Tanggal">
                            </div>
                            <div class="form-group">
                                <label for="">Sampai</label>
                                <input type="date" name="sampaippn" class="form-control datepicker" placeholder="Tanggal">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-danger btn-sm"><span class="mdi mdi-printer"> Cetak</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- @if (@isset($invoices))
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="card-title">Laporan Penjualan</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {!! session('success') !!}
                            </div>
                        @endif
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>No Invoice</th>
                                    <th>Tanggal</th>
                                    <th>Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $e=>$inv)
                                <tr>
                                    <td>{{ $e+1 }}</td>
                                    <td>{{ $inv->id }}</td>
                                    <td>{{ date('d M Y' ,strtotime($inv->tanggal)) }}</td>
                                    <td>Rp. {{ number_format($inv->total,0) }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>Total</td>
                                    <td>Rp. {{ number_format($total_pemasukan) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
    @endif --}}
@endsection