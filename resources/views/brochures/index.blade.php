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
                            <b class="card-title"> Brosur</b>
                        </div>
                            <a href="{{ route('brochures.create') }}" class="btn btn-success"><span class="mdi mdi-file-plus mdi-24px"></span></a>

                            @if ($brochures->count())
                            <div class="table-responsive">
                                <table  class="table table-hover table-bordered" id="barang-table" class="table" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            {{-- <th>ID</th> --}}
                                            <th>Judul Brosur</th>
                                            {{-- <th>File</th> --}}
                                            <th >Edit | Hapus | Download</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($brochures as $brochure)
                                            <tr>
                                                {{-- <td>{{ $brochure->id }}</td> --}}
                                                <td align="center">{{ $brochure->title }}</td>
                                                {{-- <td>{{ $brochure->file_path }}</td> --}}
                                                
                                                <td>
                                                    <a href="{{ route('brochures.edit', $brochure->id) }}" class="btn btn-warning btn-sm"><span class="mdi mdi-pencil-box mdi-18"></span></a>
                                                    <form action="{{ route('brochures.destroy', $brochure->id) }}" method="POST"
                                                        style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Are you sure?')"><span class="mdi mdi-delete mdi-18px"></span></button>
                                                    </form>
                                                    <a href="{{ route('brochures.download', $brochure->id) }}" class="btn btn-primary btn-sm"><span class="mdi mdi-cloud-download mdi-18px"></span></a>
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