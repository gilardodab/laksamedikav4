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
                                <b class="card-title">Daftar Barang</b>
                                
                            </div>
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalForm">
                                <span class="mdi mdi-share-outline">Masuk
                            </button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#keluarModal">
                                </span><span class="mdi mdi-reply-outline"></span>Keluar
                            </button>
                                <div class="col ;" style="padding-left: 85%">
                                <a class="btn btn-primary btn-sm" href="{{url('/barang-printgudang')}}" role="button"><span class="mdi mdi-printer "></span></a>
                        </div>
                        
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="barang-table" class="table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>No. Seri</th>
                                    <th>Masuk</th>
                                    <th>Jumlah Masuk</th>
                                    <th>Kerusakan</th>
                                    <th>Keluar</th>
                                    <th>Jumlah Keluar</th>
                                    <th>Hasil</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $barang)
                                <tr>
                                    <td>{{ $barang->id }}</td>
                                    <td>{{ $barang->nama_barang }}</td>
                                    <td>{{ $barang->no_seri }}</td>
                                    <td>{{ $barang->tgl_masuk }}</td>
                                    <td>{{ $barang->jumlah_masuk }}</td>
                                    <td>{{ $barang->riwayat_kerusakan_masuk }}</td>
                                    <td>{{ $barang->tgl_keluar }}</td>
                                    <td>{{ $barang->jumlah_keluar }}</td>
                                    <td>{{ $barang->riwayat_kerusakan_keluar }}</td>
                                    <td>
                                        <a href="{{ route('barang.edit', $barang->id) }}"><span class="mdi mdi-pencil-box mdi-24px"></span></a>
                                        <form action="{{ route('barang.destroy', $barang->id) }}" method="post" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="
                            
                                            margin-top: 10px;
                                            margin-bottom: 10px;
                                            padding-right: 42px;
                                            padding-left: 0px;
                                            border-top-width: 0px;
                                            border-left-width: 0px;
                                            border-right-width: 0px;
                                            border-bottom-width: 0px;
                                            height: 0px;
                                            width: 0px;
                                            padding-top: 0px;
                                            padding-bottom: 0px;
                                            
                                            " onclick="return confirm('Anda yakin ingin menghapus Customer ini?')"><span class="mdi mdi-delete-circle mdi-24px"></span></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
    
                        <!-- Modal -->
                        <div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalFormLabel">Masuk Barang</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Isi dengan form yang Anda berikan -->
                                        <form action="/masuk-barang" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label for="nama_barang">Nama Barang:</label>
                                                <input type="text" name="nama_barang" class="form-control" placeholder="Isi Nama Barang" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="no_seri">No. Seri:</label>
                                                <input type="text" name="no_seri" class="form-control" placeholder="Isi No Seri" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="tgl_masuk">Tanggal Masuk:</label>
                                                <input type="date" name="tgl_masuk" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="jumlah_masuk">Jumlah Masuk:</label>
                                                <input type="number" name="jumlah_masuk" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="riwayat_kerusakan_masuk">Riwayat Kerusakan Masuk:</label>
                                                <textarea name="riwayat_kerusakan_masuk" class="form-control"></textarea><br>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    

    
        <!-- Modal -->
        <div class="modal fade" id="keluarModal" tabindex="-1" role="dialog" aria-labelledby="keluarModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="keluarModalLabel">Keluar Barang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/keluar-barang" method="post">
                            @csrf
    
                            <div class="form-group">
                                <label for="id">ID Barang:</label>
                                <input type="number" name="id" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="tgl_keluar">Tanggal Keluar:</label>
                                <input type="date" name="tgl_keluar" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="jumlah_keluar">Jumlah Keluar:</label>
                                <input type="number" name="jumlah_keluar" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="riwayat_kerusakan_keluar">Hasil Kerusakan Keluar:</label>
                                <textarea name="riwayat_kerusakan_keluar" class="form-control"></textarea><br>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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