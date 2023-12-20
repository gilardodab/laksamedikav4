@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <b class="card-title">Add Pengajuan Service Detail</b>
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
                                        <th>Jenis Service</th>
                                        <th>Biaya Service</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- JIKA DATA KOSONG MAKA FUNGSI YANG BERJALAN ADALAH CODE BERADA PADA BLOCK CODE @3MPTY -->
                                    @forelse($details as $detail)
                                    <tr>
                                        <!-- MENAMPILKAN VALUE DARI TITLE -->
                                        <td>{{$detail->service}}</td>
                                        <td>Rp {{ number_format($detail->harga) }}</td>

                                        <td>
                                            <form class="btn-group" action="{{ url('/service-kendaraan/delete/detail/' . $detail->id) }}" method="POST">
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
                                <form action="{{ route('service.save.detail' , $servicekendaraans->id) }}" method="post">
                                    @csrf
                                    @if ($errors->any())
                                    <div class="alert alert-danger" role="alert">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                    @if (Session::has('success'))
                                    <div class="alert alert-success text-center">
                                        <p>{{ Session::get('success') }}</p>
                                    </div>
                                    @endif
                                    <table class="table table-bordered" id="dynamicTable">
                                        <tr>
                                            <th>Jenis Service</th>
                                            <th>Biaya Service</th>
                                        </tr>
                                        <tr>
                                            <input type="hidden" name="addmore[0][service_kendaraan_id]" value="{{$servicekendaraans->id}}">
                                            <td><input type="text" name="addmore[0][service]" placeholder="Masukkan jenis service" class="form-control" />
                                            <td><input type="number" name="addmore[0][harga]" placeholder="Masukkan biaya service" class="form-control" />
                                            </td>
                                            <td><button type="button" name="add" id="add" class="btn btn-outline-primary">Add</button></td>
                                        </tr>
                                    </table>
                                    <button type="submit" class="btn btn-outline-success btn-block">Save</button>
                                </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
   
        var i = 0;
           
        $("#add").click(function(){
       
            ++i;
       
            $("#dynamicTable").append('<tr><input type="hidden" name="addmore['+i+'][service_kendaraan_id]" value="{{$servicekendaraans->id}}" class="form-control" /><td><input type="text" name="addmore['+i+'][service]" placeholder="Masukkan jenis service" class="form-control" /></td><td><input type="number" name="addmore['+i+'][harga]" placeholder="Masukkan biaya service" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
        });
       
        $(document).on('click', '.remove-tr', function(){  
             $(this).parents('tr').remove();
        });  
       
    </script>
@endsection