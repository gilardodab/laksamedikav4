@extends('layouts.master')
@section('content')
@include('layouts.topNavBack')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <b class="card-title">Add Data Serial Number</b>
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
                                        <th>Serial Number</th>
                                        <th>Tanggal Pemasangan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- DIRECTIVE FORELSE SAMA DENGAN FOREACH -->
                                    <!-- HANYA SAJA SUDAH FORELSE SUDAH DILENGKAPI FUNGSI UNTUK MENGECEK DATA ADA ATAU TIDAK SEHINGGA KITA TIDAK PERLU LAGI MENGGUNAKAN IF CONDITION -->
                                    <!-- JIKA DATA KOSONG MAKA FUNGSI YANG BERJALAN ADALAH CODE BERADA PADA BLOCK CODE @3MPTY -->
                                    @forelse($details as $detail)
                                    <tr>
                                        <!-- MENAMPILKAN VALUE DARI TITLE -->
                                        <td>{{ $detail->serial_number }}</td>
                                        <td>{{ $detail->tanggal->format('D, d M Y')}}</td>
                                        <!-- TOMBOL DELETE MENGGUNAKAN METHOD DELETE DALAM ROUTING SEHINGGA KITA MEMASUKKAN TOMBOL TERSEBUT KEDALAM TAG <FORM></FORM> -->
                                        <td>
                                            <form class="btn-group" action="{{ url('/hemochroma/delete/detail/' . $detail->id) }}" method="POST">
                                                <!-- @csrf ADALAH DIRECTIVE UNTUK MEN-GENERATE TOKEN CSRF -->
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE" class="form-control">
                                                <button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini?')"><i class="mdi mdi-trash-can"></i></button>
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
                        <form action="{{ url('/hemochroma/save-detail/') }}" method="post">
                            @csrf
                            <input type="hidden" name="hemochroma_id" value="{{$hemochromas->id}}">
                            <input type="hidden" name="customer" value="{{$hemochromas->customer}}">
                            <div class="form-group">
                                <label for="">Serial Number</label>
                                <input type="text" name="serial_number" class="form-control {{ $errors->has('serial_number') ? 'is-invalid':'' }}" placeholder="Masukkan serial number alat">
                                <p class="text-danger">{{ $errors->first('serial_number') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Tanggal Pemasangan Alat</label>
                                <input type="date" name="tanggal" class="form-control {{ $errors->has('tanggal') ? 'is-invalid':'' }}" placeholder="Masukkan tanggal pemasangan alat" required>
                                <p class="text-danger">{{ $errors->first('tanggal') }}</p>
                            </div>
                            <button class="btn btn-primary btn-sm">Tambah</button>
                        </form>
                        <br><br>
                        <a class="btn btn-danger btn-sm" id="buatdatahemochroma" href="{{ url('/hemochroma') }}" role="button">Simpan Data</a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
    <script>
        $('#buatdatahemochroma').on("click",function(){
        alert("Penambahan data sudah selesai?")
        })
    </script>
@endsection