@extends('layouts.master')
@section('content')
@include('layouts.topNavBack')
<div class="container">
    <div class="row" style= "margin-top: 80px; margin-bottom: 80px">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
<!-- resources/views/sponsor_request/create.blade.php -->
<a href="{{('/sponsor-request/index') }}">Riwayat<i class="mdi mdi-pencil"></i></a>
<form action="{{ url('/sponsor-request') }}" method="post">
    @csrf
    <div class="form-group">
        <h4>PENGAJUAN SPONSOR</h4>
        <label for="jenis_sponsor">Jenis Sponsor</label>
        <input type="text" name="jenis_sponsor" class="form-control " placeholder="Isi Jenis Sponsor" required>
    </div>
    <div class="form-group">
        <label for="jumlah_rupiah">Jumlah Rupiah</label>
        <input type="number" name="jumlah_rupiah" class="form-control "placeholder="Isi Jumlah Rupiah" required>
    </div>
    <div class="form-group">
        <label for="waktu_kegiatan">Waktu Kegiatan</label>
        <input type="datetime-local" name="waktu_kegiatan" class="form-control" placeholder="Isi Waktu" required>
    </div>
    <button type="submit" class= "btn btn-primary btn-block">Ajukan</button>
</form>

@if(session('status'))
    <p>{{ session('status') }}</p>
@endif
</div>
</div>
</div>
</div>
</div>
@endsection