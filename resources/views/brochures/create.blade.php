
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
                            <b class="card-title">Tambah Brosur</b>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('brochures.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="title">Judul Brosur:</label>
                                <input type="text" name="title" class="form-control" required placeholder="Contoh: BloodBag.pdf">
                            </div>
                            <div class="form-group">
                                <label for="file">File:</label>
                                <input type="file" name="file" class="form-control-file" required>
                            </div>
                            <button type="submit" class="btn btn-primary"><span class="mdi mdi-content-save mdi-18px"></span>Simpan</button>
                        </form>
 @endsection
