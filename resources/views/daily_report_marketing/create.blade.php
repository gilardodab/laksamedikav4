@extends('layouts.master')

@section('content')
@include('layouts.topNavBack')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <b class="card-title">Tambah Marketing</b>
                    </div>
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{ url('/daily-report-marketing') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Customer</label>
                                <input type="text" name="customer" class="form-control {{ $errors->has('customer') ? 'is-invalid':'' }}" placeholder="Contoh : PMI Yogyakarta" required>
                                <p class="text-danger">{{ $errors->first('customer') }}</p>
                            </div>
                            <!--<div class="form-group">-->
                            <!--    <label for="">Address</label>-->
                            <!--    <input type="text" name="address" cols="10" rows="10" class="form-control form-control-lg {{ $errors->has('address') ? 'is-invalid':'' }}"placeholder="Alamat Outlet" required>-->
                            <!--    <p class="text-danger">{{ $errors->first('address') }}</p>-->
                            <!--</div>-->
                            <button class="btn btn-primary btn-sm">Next</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
