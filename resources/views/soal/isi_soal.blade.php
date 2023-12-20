@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <b class="card-title">Add Soal Test Knowledge</b>
                    </div>
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {!! session('success') !!}
                                </div>
                            @endif
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Soal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- DIRECTIVE FORELSE SAMA DENGAN FOREACH -->
                                    <!-- HANYA SAJA SUDAH FORELSE SUDAH DILENGKAPI FUNGSI UNTUK MENGECEK DATA ADA ATAU TIDAK SEHINGGA KITA TIDAK PERLU LAGI MENGGUNAKAN IF CONDITION -->
                                    <!-- JIKA DATA KOSONG MAKA FUNGSI YANG BERJALAN ADALAH CODE BERADA PADA BLOCK CODE @3MPTY -->
                                    @forelse($soaldetails as $e=>$soaldetail)
                                    <tr>
                                        <!-- MENAMPILKAN VALUE DARI TITLE -->
                                        <td colspan="1" align="center">{{ $e+1 }}</td>
                                        <td>{{ $soaldetail->soal }}</td>
                                        <!-- TOMBOL DELETE MENGGUNAKAN METHOD DELETE DALAM ROUTING SEHINGGA KITA MEMASUKKAN TOMBOL TERSEBUT KEDALAM TAG <FORM></FORM> -->
                                        <td>
                                            <form class="btn-group" action="{{ url('/soal/delete/soal/' . $soaldetail->id) }}" method="POST">
                                                <!-- @csrf ADALAH DIRECTIVE UNTUK MEN-GENERATE TOKEN CSRF -->
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE" class="form-control">
                                                <button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus kondisi ini?')"><i class="mdi mdi-trash-can"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td class="text-center" colspan="6">Empty Data</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-body">
                        <form action="{{ url('/soal/savesoal/') }}" method="post">
                            @csrf
                            <input type="hidden" name="soal_id" value="{{$soals->id}}">
                            <div class="form-group">
                                <label for="">Soal Test Knowledge</label>
                                <input type="text" name="soal" class="form-control {{ $errors->has('soal') ? 'is-invalid':'' }}" placeholder="Tulis soal disini">
                                <p class="text-danger">{{ $errors->first('soal') }}</p>
                            </div>
                            <button class="btn btn-primary btn-sm">Tambah Soal</button>
                        </form>
                        </div>
            </div>
        </div>
    </div>
</div>
@endsection