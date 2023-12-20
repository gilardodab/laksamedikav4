<!-- resources/views/invoice/allinvoice.blade.php -->
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
                                <b class="card-title">Daftar Invoice</b>
                            </div>
                            <div class="card-body">
                                <!-- Konten spesifik untuk invoice non PPN -->
                                <a href="{{ route('invoiceppn.allinvoice') }}" class="btn btn-secondary btn-sm btn-block">Invoice PPN</a>
                               
                            </div>
                            <div class="card-body">
                                <!-- Konten spesifik untuk invoice non PPN -->
                                
                                <a href="{{ route('invoice.allinvoice') }}" class="btn btn-primary btn-sm btn-block">Invoice Non PPN</a>
                            </div>
                            <div class="card-footer">
                                
                                
                                <a href="{{ route('invoicecustomer.allinvoice') }}" class="btn btn-primary btn-sm btn-block">Invoice Customer</a>
                            </div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
