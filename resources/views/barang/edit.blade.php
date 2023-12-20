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
                            <b class="card-title">Edit Barang</b>
                        </div>
                            <form action="{{ route('barang.update', $barang->id) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="nama_barang">Nama Barang:</label>
                                    <input type="text" name="nama_barang"  class="form-control " value="{{ $barang->nama_barang }}" required>
                                </div>
                                <div class="form-group">
                                <label for="no_seri">No. Seri :</label>
                                <input type="text" name="no_seri" value="{{ $barang->no_seri }}" class="form-control " required><br>
                                </div>
                                <div class="form-group">
                                <label for="tgl_masuk">Tgl Masuk:</label>
                                <input type="date" name="tgl_masuk" value="{{ $barang->tgl_masuk }}" class="form-control " required><br>
                                </div>
                                <div class="form-group">
                                <label for="riwayat_kerusakan_masuk">Riwayat Kerusakan Masuk:</label>
                                <input type="textarea" name="riwayat_kerusakan_masuk" value="{{ $barang->riwayat_kerusakan_masuk }}" class="form-control " required><br>
                                </div>
                                <div class="form-group">
                                <label for="jumlah_masuk">Jumlah Masuk:</label>
                                <input type="number" name="jumlah_masuk" value="{{ $barang->jumlah_masuk }}" class="form-control " ><br>
                                </div>
                                <div class="form-group">
                                <label for="tgl_keluar">Tgl Keluar:</label>
                                <input type="date" name="tgl_keluar" value="{{ $barang->tgl_keluar}}" class="form-control " ><br>
                                </div>
                                <div class="form-group">
                                <label for="jumlah_keluar">Jumlah Keluar:</label>
                                <input type="number" name="jumlah_keluar" value="{{ $barang->jumlah_keluar}}" class="form-control " ><br>
                                </div>
                                <div class="form-group">
                                <label for="riwayat_kerusakan_keluar">Riwayat Kerusakan Keluar:</label>
                                <input type="textarea" name="riwayat_kerusakan_keluar" value="{{ $barang->riwayat_kerusakan_keluar}}" class="form-control "><br>
                                </div>
                                <!-- Tambahkan input lain sesuai kebutuhan -->
                                <button type="submit" class="btn btn-primary btn-block">SIMPAN</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
