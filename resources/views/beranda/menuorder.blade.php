<!-- resources/views/invoice/allinvoice.blade.php -->
@extends('layouts.master')
@section('content')
@include('layouts.topNavBack')
<!-- Extra Header -->
<div class="extraHeader p-0">
    <ul class="nav nav-tabs lined" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#nonppn" role="tab">
                ORDER NONPPN
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#ppn" role="tab">
                ORDER PPN
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
                        <div class="row" style="margin-top: 25px; margin-bottom: 80px;">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row" >
                                            <div class="col-md-12">
                                                <b class="card-title">Tambah Invoice NONPPN</b>
                                            </div><br>
                                            <div class="col-md-6">
                                                <form action="#" method="GET" class="form-inline">
                                                    <input class="form-control mr-sm-2" id="search" name="cari" type="search" placeholder="Search" aria-label="Search">
                                                    <img id="loader" src="{{asset('assets/images/loading.gif')}}" width="25" alt=""
                                                    style="display:none">
                                                    </form>
                                            </div>
                                        </div>
                                    </div>
                                            <div class="card-body">
                                                @if (session('error'))
                                                    <div class="alert alert-danger">
                                                        {{ session('error') }}
                                                    </div>
                                                @endif
                                            
                                            <table class="table table-hover table-bordered" id="ordernonppn-table" class="table" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>Nama </th>
                                                        <th>Tambah</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($customers as $customer)
                                                    <tr>
                                                        <td>{{ $customer->name }}</td>
                                                        <td>
                                                            <form action="{{ route('invoice.store') }}" method="post">
                                                                @csrf
                                                                <input type="hidden" name="customer_id" value="{{ $customer->id }}" class="form-control">
                                                                <button class="btn btn-primary btn-sm"><ion-icon name="add-circle-outline"></ion-icon></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <td class="text-center" colspan="5">Empty Data</td>
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
            </div>

        </div>
        <!-- * nonppn tab -->



        <!-- ppn tab -->
        <div class="tab-pane fade" id="ppn" role="tabpanel">
            <div class="wide-block pt-2 pb-2">
                <div class="container">
                    <div class="row" style="margin-top: 25px; margin-bottom: 80px;">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <b class="card-title">Tambah Invoice PPN</b>
                                        </div><br>
                                        <div class="col-md-6">
                                            <form action="#" method="GET" class="form-inline">
                                                <input class="form-control mr-sm-2" id="search" name="cari" type="search" placeholder="Search" aria-label="Search">
                                                <img id="loader" src="{{asset('assets/images/loading.gif')}}" width="25" alt=""
                                                style="display:none">
                                                </form>
                                        </div>
                                    </div>
                                </div>
                                        <div class="card-body">
                                            @if (session('error'))
                                                <div class="alert alert-danger">
                                                    {{ session('error') }}
                                                </div>
                                            @endif
                                        
                                            <table class="table table-hover table-bordered" id="orderppn-table" class="table" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Tambah</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($customers as $customer)
                                                <tr>
                                                    <td>{{ $customer->name }}</td>
                                                    <td>
                                                        <form action="{{ route('invoiceppn.store') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="customer_id" value="{{ $customer->id }}" class="form-control">
                                                            <button class="btn btn-primary btn-sm"><ion-icon name="add-circle-outline"></ion-icon></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td class="text-center" colspan="5">Empty Data</td>
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
        </div>
        <!-- * ppn tab -->


        <!-- customer tab -->

        <!-- * customer tab -->
        @include('layouts.topNavBack')
@endsection
