@extends('layouts.master')

@section('content')
@include('layouts.topNavBack')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-12">
                            </div>
                            <div class="col-md-6">
                                <table>
                                    <tr>
                                        <td width="30%">Customer</td>
                                        <td>:</td>
                                        <td>{{ $invoiceppn->customer->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td>:</td>
                                        <td>{{ $invoiceppn->customer->address }}</td>
                                    </tr>
                                    <tr>
                                        <td>Phone</td>
                                        <td>:</td>
                                        <td>{{ $invoiceppn->customer->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>:</td>
                                        <td>{{ $invoiceppn->customer->email }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table>
                                    <tr>
                                        <td width="20%">Dari</td>
                                        <td>:</td>
                                        <td>PT Laksa Medika Internusa</td>
                                    </tr>
                                    <tr>
                                        <td>Address </td>
                                        <td>:</td>
                                        <td>Pelem Lor No.50 Bantul Yogyakarta</td>
                                    </tr>
                                    <tr>
                                        <td>Phone</td>
                                        <td>:</td>
                                        <td> 0274-4436047</td>
                                    </tr>
                                    <tr>
                                        <td>Tenggat</td>
                                        <td>:</td>
                                        <td> {{ date('Y-m-d H:i:s', time() + (60*60*24*30)) }}</td>
                                    </tr>
                                 
                                        
                            
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>Product</td>
                                            <td>Quantity</td>
                                        </tr>
                                    </thead>
                                    
                                    <!-- MENAMPILKAN PRODUK YANG TELAH DITAMBAHKAN -->
                                    <tbody>
                                        @php $no = 1 @endphp
                                        @foreach ($invoiceppn->detailppn as $detail)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $detail->product_detail->product->title }}</td>
                                            <td>{{ $detail->qty }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>                 
                                    <!-- FORM UNTUK MEMILIH PRODUK YANG AKAN DITAMBAHKAN -->
                                    <tfoot>
                                    </tfoot>
                                    <!-- FORM UNTUK MEMILIH PRODUK YANG AKAN DITAMBAHKAN -->
                                </table>

                                <div class="card-header">
                                    <b class="card-title">Pengiriman Barang</b>
                                </div>
                                <div class="table-responsive">
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {!! session('success') !!}
                                        </div>
                                    @endif
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Produk</th>
                                                <th>Quantity</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- DIRECTIVE FORELSE SAMA DENGAN FOREACH -->
                                            <!-- HANYA SAJA SUDAH FORELSE SUDAH DILENGKAPI FUNGSI UNTUK MENGECEK DATA ADA ATAU TIDAK SEHINGGA KITA TIDAK PERLU LAGI MENGGUNAKAN IF CONDITION -->
                                            <!-- JIKA DATA KOSONG MAKA FUNGSI YANG BERJALAN ADALAH CODE BERADA PADA BLOCK CODE @3MPTY -->
                                            @php $no = 1 @endphp
                                            @forelse($invoiceppn->pengirimanppn as $pengiriman)
                                            <tr>
                                                <!-- MENAMPILKAN VALUE DARI TITLE -->
                                                <td>{{ $no++ }}</td>
                                                <td>{{$pengiriman->product_detail->product->title}}</td>
                                                <td>{{$pengiriman->qty}}</td>
        
                                                <!-- TOMBOL DELETE MENGGUNAKAN METHOD DELETE DALAM ROUTING SEHINGGA KITA MEMASUKKAN TOMBOL TERSEBUT KEDALAM TAG <FORM></FORM> -->
                                                <td>
                                                    <form class="btn-group" action="{{ route('invoiceppn.deletepengirimanppn', $pengiriman->id) }}" method="POST">
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

                                <div class="col-md-6">
                                    <form action="{{ url('/invoiceppn/simpan/pengiriman', ['id' => $invoiceppn->id]) }}" method="post">
                                        @csrf
                                    <div class="form-group">
                                        <br/>
                                        <label for="">Product</label>
                                        <input type="hidden" name="_method" value="PUT" class="form-control">
                                        <select name="invoice_detailppn_id" id="product_ajax" class="form-control">
                                            <option value="">Select Product</option>
                                            @foreach ($invoiceppn->detailppn as $detail)
                                            {{-- @if($detail->id == $invoice->product_detail_id) --}}
                                            <option value="{{ $detail->id }}"> {{ $detail->product_detail->product->title}}
                                            </option>
                                            {{-- @endif --}}
                                            @endforeach
                                          
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Quantity Pengiriman</label>
                                        <input type="number" id="qty" name="qty" class="form-control" placeholder="Jumlah yang akan dikirim">                        
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-sm">Kirim Produk</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection