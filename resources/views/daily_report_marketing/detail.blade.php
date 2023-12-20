@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <b class="card-title">Add Daily Report Detail</b>
                    </div>
                    <div class="table-responsive">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="table-responsive">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {!! session('success') !!}
                                </div>
                            @endif
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Tujuan</th>
                                        <th>Petugas</th>
                                        <th>No HP</th>
                                        <th>Produk</th>
                                        <th>Penjelasan</th>
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
                                        <td>{{$detail->tanggal->format('D, d M Y')}}</td>
                                        <td>{{$detail->tujuan}}</td>
                                        <td>{{$detail->petugas}}</td>
                                        <td>{{$detail->no_hp}}</td>
                                        <td>{{$detail->produk}}</td>
                                        <td>{{$detail->penjelasan}}</td>

                                        <!-- TOMBOL DELETE MENGGUNAKAN METHOD DELETE DALAM ROUTING SEHINGGA KITA MEMASUKKAN TOMBOL TERSEBUT KEDALAM TAG <FORM></FORM> -->
                                        <td>
                                            <form class="btn-group" action="{{ url('/daily-report-marketing/delete/detail/' . $detail->id) }}" method="POST">
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
                        <form action="{{ url('/daily-report-marketing/save-detail/' . $dailyreportmkts->id) }}" method="post">
                            @csrf
                            <input type="hidden" name="daily_report_marketing_id" value="{{$dailyreportmkts->id}}">
                            <div class="form-group">
                                <label for="">Tanggal</label>
                                <input type="date" name="tanggal" class="form-control {{ $errors->has('tanggal') ? 'is-invalid':'' }}" placeholder="Masukkan tanggal" required>
                                <p class="text-danger">{{ $errors->first('tanggal') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Tujuan</label>
                                <input type="text" name="tujuan" class="form-control {{ $errors->has('tujuan') ? 'is-invalid':'' }}" placeholder="Masukkan tujuan kunjungan" required>
                                <p class="text-danger">{{ $errors->first('tujuan') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Petugas</label>
                                <input type="text" name="petugas" class="form-control {{ $errors->has('petugas') ? 'is-invalid':'' }}" placeholder="Masukkan petugas yang ditemui" required>
                                <p class="text-danger">{{ $errors->first('petugas') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">No HP</label>
                                <input type="text" name="no_hp" class="form-control {{ $errors->has('no_hp') ? 'is-invalid':'' }}" placeholder="Masukkan No HP petugas" required>
                                <p class="text-danger">{{ $errors->first('no_hp') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Produk</label>
                                <input type="text" name="produk" class="form-control {{ $errors->has('produk') ? 'is-invalid':'' }}" placeholder="Masukkan produk yang ditawarkan" required>
                                <p class="text-danger">{{ $errors->first('produk') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Penjelasan</label>
                                <textarea name="penjelasan" class="form-control {{ $errors->has('penjelasan') ? 'is-invalid':'' }}" placeholder="Masukkan produk yang ditawarkan" required></textarea>
                                <p class="text-danger">{{ $errors->first('penjelasan') }}</p>
                            </div>
                            <button class="btn btn-primary btn-sm">Tambah Data</button>
                        </form>
                        <br><br>
                        <a class="btn btn-danger btn-sm" id="buatdailyreport" href="{{ url('/daily-report-marketing/')}}" role="button">Kembali</a>
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
        $('#buatdailyreport').on("click",function(){
        alert("Penambahan data sudah selesai?")
        })
    </script>
@endsection