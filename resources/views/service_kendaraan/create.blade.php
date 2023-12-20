@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <b class="card-title">Add Pengajuan Service</b>
                    </div>
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{ url('/service-kendaraan') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Nama Pemakai</label>
                                <input type="text" name="nama" class="form-control {{ $errors->has('nama') ? 'is-invalid':'' }}" placeholder="isi Nama Pemakai">
                                <p class="text-danger">{{ $errors->first('nama') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Nama Kendaraan</label>
                                <input type="text" name="merk_mobil" class="form-control {{ $errors->has('merk_mobil') ? 'is-invalid':'' }}" placeholder="Contoh : Suzuki Ertiga">
                                <p class="text-danger">{{ $errors->first('merk_mobil') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Tanggal</label>
                                <input type="date" name="tanggal" class="form-control {{ $errors->has('tanggal') ? 'is-invalid':'' }}">
                                <p class="text-danger">{{ $errors->first('tanggal') }}</p>
                            </div>
                           
                            <button class="btn btn-primary btn-sm">Lanjut</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
