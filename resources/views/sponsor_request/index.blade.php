@extends('layouts.master')
@section('content')
@include('layouts.topNavBack')
<div class="container">
    <div class="row" style= "margin-top: 80px; margin-bottom: 80px">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
<!-- resources/views/sponsor_request/index.blade.php -->

<!-- resources/views/sponsor_request/history.blade.php -->

<table>
    <thead>
        <tr>
            <th>Jenis Sponsor</th>
            <th>Jumlah Rupiah</th>
            <th>Waktu Kegiatan</th>
            <th>Status</th>
            <th>Nama Pengguna</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($requests as $request)
            <tr>
                <td>{{ $request->jenis_sponsor }}</td>
                <td>{{ $request->jumlah_rupiah }}</td>
                <td>{{ $request->waktu_kegiatan }}</td>
                <td>{{ $request->status }}</td>
                {{-- <td>{{ $request->$id }}</td> --}}
                {{-- <td>{{ $request->user ? $request->user->name : 'User Tidak Diketahui' }}</td> --}}
                <td>
                    <a href="{{ route('sponsor-request.edit', $request) }}"><i class="mdi mdi-pencil"></i></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


@if(session('status'))
    <p>{{ session('status') }}</p>
@endif
</div>
</div>
</div>
</div>
</div>
@endsection 