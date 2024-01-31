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
                                        <td>Address</td>
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
                                            <td>Price</td>
                                            <td>Diskon</td>
                                            <td>Subtotal</td>
                                            <th>Hapus</th>
                                        </tr>
                                    </thead>
                                    
                                    <!-- MENAMPILKAN PRODUK YANG TELAH DITAMBAHKAN -->
                                    <tbody>
                                        @php $no = 1 @endphp
                                        @foreach ($invoiceppn->detailppn as $detailppn)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $detailppn->product_detail->product->title }}</td>
                                            <td>{{ $detailppn->qty }}</td>
                                            <td>Rp {{ number_format($detailppn->price) }}</td>
                                            <td>Rp {{ number_format($detailppn->diskon) }}</td>
                                            <td>Rp {{ $detailppn->subtotal }}</td>
                                            <td> <form></form>
                                                <form action="{{ route('invoiceppn.delete_product', ['id' => $detailppn->id]) }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="DELETE" class="form-control">
                                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus produk ini?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <!-- MENAMPILKAN PRODUK YANG TELAH DITAMBAHKAN -->
                                    
                                    <!-- FORM UNTUK MEMILIH PRODUK YANG AKAN DITAMBAHKAN -->
                                    <tfoot>
                                    </tfoot>
                                    <!-- FORM UNTUK MEMILIH PRODUK YANG AKAN DITAMBAHKAN -->
                                </table>
                            </div>
                            <div class="col-md-6">
                                <form action="{{ route('invoiceppn.update', ['id' => $invoiceppn->id]) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <br/>
                                    <label for="">Product</label>
                                    <input type="hidden" name="_method" value="PUT" class="form-control">
                                    <select name="product_detail_id" id="product_ajax" class="form-control">
                                        <option value="">Select Product</option>
                                        @foreach ($details as $detail)
                                        @if($detail->customer_id == $invoiceppn->customer_id)
                                        <option value="{{ $detail->id }}"> {{ $detail->product->title}}
                                        </option>
                                        @endif
                                        @endforeach
                                      
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Quantity</label>
                                    <div id="qtyProduct"></div>
                                    <input type="number" id="qty" name="qty" class="form-control" placeholder="Qty">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" value="{{ date('Y-m-d H:i:s', time() + (60*60*24*31)) }}" name="tenggat" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label for="">Diskon</label>
                                    <input type="text" name="diskon" class="form-control" placeholder="Miss: 100000">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" value="{{ date('Y-m-d H:i:s', time()) }}" name="tanggal" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <input type="hidden" value="{{ Auth::user()->id }}" name="user_id" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm">Buat Faktur</button>
                                </div>
                            </div>
                            </form>
                            
                            <!-- MENAMPILKAN TOTAL & TAX -->
                            <div class="col-md-4 offset-md-8">
                                <table class="table table-hover table-bordered">
                                    <tr>
                                        <td>Sub Total</td>
                                        <td>:</td>
                                        <td>Rp {{ number_format($invoiceppn->total) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tax</td>
                                        <td>:</td>
                                        <td>11% (Rp {{ number_format($invoiceppn->tax) }})</td>
                                    </tr>
                                    <tr>
                                        <td>Total Price</td>
                                        <td>:</td>
                                        <td>Rp {{ number_format($invoiceppn->total_price) }}</td>
                                    </tr>
                                </table>
                            </div>
                            <!-- MENAMPILKAN TOTAL & TAX -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#product_ajax').change(function() {
            let id = $(this).children("option:selected").val()
            console.log(id)
            if (id != 0) {
                $.ajax({
                    url: '/api/product/' + id,
                    type: 'get',
                    dataType: 'html'
                }).done(function(data) {
                    json = JSON.parse(data)
                    console.log(json)
                    qty = json['product']['stock']
                    $('#qtyProduct').html("Stok saat ini : " + qty);
                    $('#qty').attr('max', qty);
                    $('#qty').attr('min', 1);
                })
            }
        
        })
        </script>
@endsection