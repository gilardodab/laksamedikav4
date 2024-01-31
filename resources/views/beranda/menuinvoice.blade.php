<!-- resources/views/invoice/allinvoice.blade.php -->
@extends('layouts.master')
@section('content')
@include('layouts.topNavBack')
<!-- Extra Header -->
<div class="extraHeader p-0">
    <ul class="nav nav-tabs lined" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#nonppn" role="tab">
                INVOICE NONPPN
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#ppn" role="tab">
                INVOICE PPN
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#customer" role="tab">
                INVOICE CUSTOMER
            </a>
        </li>
    </ul>
</div>
<!-- * Extra Header -->

<!-- App Capsule -->
<div  class="extra-header-active">


    <div class="tab-content mt-1">


        <!-- nonppn tab -->
        <div class="tab-pane fade show active" id="nonppn" role="tabpanel">

            <div class="section full mt-1">
                <div class="wide-block pt-2 pb-2">
                    <div class="container">
                        <div class="row" style="margin-top: 40px; ">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <b class="card-title">Data Semua Invoice NONPPN</b>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        @if (session('success'))
                                            <div class="alert alert-success">
                                                {!! session('success') !!}
                                            </div>
                                        @endif
                                        <table class="table table-hover table-bordered" id="invoice-table" class="table" cellspacing="0" width="100%">
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
                                            <tbody class="cards">
                                                {{-- @if ($invoice->user->id == Auth::user()->id) --}}
                                                @foreach ($allinvoice as $invoice)
                                                @isset ($invoice->user)
                                                    <tr>
                                                        <td><strong>{{ $invoice->no_faktur_2023 }}</strong></td>
                                                        <td>{{ $invoice->customer->name }}</td>
                                                        <td>{{ $invoice->user->name }}</td>
                                                        <td><span class="badge badge-success">{{ $invoice->detail->count() }} Item</span></td>
                                                        <td>Rp {{ number_format($invoice->total) }}</td>
                                                        <td>Rp {{ number_format($invoice->tax) }}</td>
                                                        <td>Rp {{ number_format($invoice->total_price) }}</td>
                                                        <td>
                                                            <form class="btn-group" action="{{ route('invoice.destroy', $invoice->id) }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <a href="{{ route('invoice.print', $invoice->id) }}" class="btn btn-secondary btn-sm"><i class="mdi mdi-printer"></i></a>
                                                                <a href="{{ route('invoice.edit', $invoice->id) }}" class="btn btn-warning btn-sm"><i class="mdi mdi-pencil" ></i></a>
                                                                <a href="{{ route('invoice.print2', $invoice->id) }}" class="btn btn-success btn-sm"><i class="mdi mdi-printer"></i></a>
                                                                <a href="{{ route('invoice.kirim', $invoice->id) }}" class="btn btn-primary btn-sm"><i class="mdi mdi-truck-delivery"></i></a>
                                                                <button class="btn btn-danger btn-sm " onclick="return confirm('Anda yakin ingin menghapus faktur ini?')"><i class="mdi mdi-trash-can" ></i></button>
                                                            </form>
                                                        </td>
                                                        <td> 
                                                            <a href="{{ route('invoice.status', $invoice->id) }}" class="btn btn-primary btn-sm" onclick="return confirm('Anda yakin faktur ini sudah lunas?')">Lunas</a>
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

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- * nonppn tab -->



        <!-- ppn tab -->
        <div class="tab-pane fade" id="ppn" role="tabpanel">
            <div class="wide-block pt-2 pb-2">
            <div class="container">
                <div class="row" style="margin-top: 40px; ">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row" style="margin-bottom: 10px">
                                    <div class="col-md-12">
                                    <div class="col-md-6">
                                            <b class="card-title">Data Semua Invoice PPN</b>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {!! session('success') !!}
                                        </div>
                                    @endif
                                    <table class="table table-hover table-bordered" id="invoiceppn-table" class="table" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No Invoice</th>
                                                <th>Name</th>
                                                <th>Marketing</th>
                                                <th>Total Item</th>
                                                <th>Subtotal</th>
                                                <th>Tax</th>
                                                <th>Total Price</th>
                                                <th><center>Menu</center></th>
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

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- * ppn tab -->


        <!-- customer tab -->
        <div class="tab-pane fade" id="customer" role="tabpanel">

            <div class="section full mt-1">
                <div class="wide-block pt-2 pb-2">
                <div class="container">
                    <div class="row" style="margin-top: 40px; ">
                        <div class="col-md-12">

                            <div class="card">
            
                                <div class="card-header">
            
                                    <div class="row">
            
                                        <div class="col-md-6">
            
                                            <b class="card-title">Daftar Semua Pesanan Customer</b>
            
                                        </div>
            
                                    </div>
            
                                </div>
            
                                <div class="table-responsive">
            
                                    @if (session('success'))
            
                                        <div class="alert alert-success">
            
                                            {!! session('success') !!}
            
                                        </div>
            
                                    @endif
            
                                    <table class="table table-hover table-bordered" id="invoicecs-table" class="table" cellspacing="0" width="100%">

            
                                        <thead>
            
                                            <tr>
            
                                                <th>No Invoice</th>
            
                                                <th>Name</th>
            
                                                <th>Total Item</th>
            
                                                <th>Subtotal</th>
            
                                                <th>Tax</th>
            
                                                <th>Total Price</th>
            
                                                <th><center>Action</center></th>
            
                                            </tr>
            
                                        </thead>
            
                                        <tbody>
            
                                            {{-- @if ($invoice->user->id == Auth::user()->id) --}}
            
                                            @foreach ($invoicecustomerall as $invoicecustomers)
            
                                                <tr>
            
                                                    <td><strong>{{ $invoicecustomers->no_faktur }}</strong></td>
            
                                                    <td>{{ $invoicecustomers->user->name }}</td>
            
                                                    <td><span class="badge badge-success">{{ $invoicecustomers->detail_customer->count() }} Item</span></td>
            
                                                    <td>Rp {{ number_format($invoicecustomers->total) }}</td>
            
                                                    <td>Rp {{ number_format($invoicecustomers->tax) }}</td>
            
                                                    <td>Rp {{ number_format($invoicecustomers->total_price) }}</td>
            
                                                    <td>
            
                                                        <form class="btn-group" action="{{ route('invoicecustomer.destroy', $invoicecustomers->id) }}" method="POST">
            
                                                            @csrf
            
                                                            <input type="hidden" name="_method" value="DELETE">
            
                                                            @if ($invoicecustomers->ppn != 0)
            
                                                            <a href="{{ route('invoicecustomer.print', $invoicecustomers->id) }}" class="btn btn-secondary btn-sm"><i class="mdi mdi-printer"></i></a>
            
                                                            @else
            
                                                            <a href="{{ route('invoicecustomer.printnonppn', $invoicecustomers->id) }}" class="btn btn-success btn-sm"><i class="mdi mdi-printer"></i></a>
            
                                                            @endif
            
                                                            <a href="{{ route('invoicecustomer.edit', $invoicecustomers->id) }}" class="btn btn-warning btn-sm"><i class="mdi mdi-pencil"></i></a>
            
                                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus faktur ini?')"><i class="mdi mdi-trash-can"></i></button>
            
                                                        </form>
            
                                                    </td>
            
                                                    {{-- <td> 
            
                                                        <a href="{{ route('invoice.status', $invoicecustomers->id) }}" class="btn btn-primary btn-sm" onclick="return confirm('Anda yakin faktur ini sudah lunas?')">Lunas</a>
            
                                                    </td> --}}
            
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- * customer tab -->
        @include('layouts.topNavBack')
@endsection
