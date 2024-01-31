@extends('layouts.master')
@section('content')
@include('layouts.topNavBack')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-11">
                                <b class="card-title">Laporan Barang</b>
                            </div>
                            <a class="btn btn-primary" href="{{url('/barang-print')}}" role="button"><span class="mdi mdi-printer"> Print</span></a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {!! session('success') !!}
                            </div>
                        @endif
                        <table class="table table-hover table-bordered" id="lapbarang-table" class="table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    {{-- <th>Harga</th> --}}
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $product)
                                <tr>
                                    <!-- MENAMPILKAN VALUE DARI TITLE -->
                                    <td>{{ $product->title }}</td>
                                    {{-- <td>Rp {{ number_format($product->price) }}</td> --}}
                                    <td>{{ $product->stock }}</td>
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