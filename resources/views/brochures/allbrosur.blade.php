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
                            <b class="card-title">Daftar Brosur</b>
                        </div>
                            @if ($brochures->count())
                            <div class="table-responsive">
                                <table  class="table table-hover table-bordered" id="barang-table" class="table" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            {{-- <th>ID</th> --}}
                                            {{-- <th>Judul Brosur</th> --}}
                                            {{-- <th>File</th> --}}
                                            <th>Unduh File</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        @foreach ($brochures as $brochure)
                                            <tr>
                                                {{-- <td>{{ $brochure->id }}</td> --}}
                                                {{-- <td align="center">{{ $brochure->title }}</td> --}}
                                                {{-- <td>{{ $brochure->file_path }}</td> --}}
                                                <td align="center">
                                                    <a href="{{ route('brochures.download', $brochure->id) }}">{{ $brochure->title }} <span class="mdi mdi-cloud-download mdi-18px"></span></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                                <p>No brochures available.</p>
                            @endif
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
<!-- Add DataTables.js JS -->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

</div>
</div>
</div>
</div>