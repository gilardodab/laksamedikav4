@extends('layouts.master')

@section('content')
@include('layouts.topNavBack')
<div class="container">
    <div class="row" style="margin-top: 80px; ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row" style="margin-bottom: 100px">
                        <div class="col-md-12">
                        <div class="col-md-6">
                                <b class="card-title">All Invoice PPN</b>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {!! session('success') !!}
                            </div>
                        @endif
                        <table class="table table-hover table-bordered" id="barang-table" class="table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No Invoice</th>
                                    <th>Name</th>
                                    <th>Marketing</th>
                                    <th>Total Item</th>
                                    <th>Subtotal</th>
                                    <th>Tax</th>
                                    <th>Total Price</th>
                                    <th><center>Action</center></th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @if ($invoice->user->id == Auth::user()->id) --}}
                                @foreach ($allinvoiceppn as $invoice)
                                @isset ($invoice->user)
                                    <tr>
                                        <td><strong>{{ $invoice->no_faktur_2023 }}</strong></td>
                                        <td>{{ $invoice->customer->name }}</td>
                                        <td>{{ $invoice->user->name }}</td>
                                        <td><span class="badge badge-success">{{ $invoice->detailppn->count() }} Item</span></td>
                                        <td>Rp {{ number_format($invoice->total) }}</td>
                                        <td>Rp {{ number_format($invoice->tax) }}</td>
                                        <td>Rp {{ number_format($invoice->total_price) }}</td>
                                        <td>
                                            <form class="btn-group" action="{{ route('invoiceppn.destroy', $invoice->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <a href="{{ route('invoiceppn.print', $invoice->id) }}" class="btn btn-secondary btn-sm"><i class="mdi mdi-printer"></i></a>
                                                <a href="{{ route('invoiceppn.edit', $invoice->id) }}" class="btn btn-warning btn-sm"><i class="mdi mdi-pencil" ></i></a>
                                                {{-- <a href="{{ route('invoiceppn.print2', $invoice->id) }}" class="btn btn-success btn-sm"><i class="mdi mdi-printer"></i></a> --}}
                                                <a href="{{ route('invoiceppn.pengirimanppn', $invoice->id) }}" class="btn btn-primary btn-sm"><i class="mdi mdi-truck-delivery"></i></a>
                                                <button class="btn btn-danger btn-sm " onclick="return confirm('Anda yakin ingin menghapus faktur ini?')"><i class="mdi mdi-trash-can" ></i></button>
                                            </form>
                                        </td>
                                        <td> 
                                            <a href="{{ route('invoiceppn.status', $invoice->id) }}" class="btn btn-primary btn-sm" onclick="return confirm('Anda yakin faktur ini sudah lunas?')">Lunas</a>
                                        </td>
                                    </tr>
                                {{-- @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Empty Data</td>
                                    </tr> --}}
                                    @endisset
                                @endforeach
                                    {{-- @endif --}}
                            </tbody>
                        </table>
                        <div class="float-right">
                            {{ $allinvoiceppn->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection