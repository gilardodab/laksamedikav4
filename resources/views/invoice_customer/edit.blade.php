@extends('layouts.master')

@section('content')
@include('layouts.topNavBack')
    <div class="container">
        <div class="row" style= "margin-top: 80px; margin-bottom: 80px">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="row">
                            {{-- <div class="col-md-12">
                            </div>
                            <div class="col-md-6">
                                <table>
                                    <tr>
                                        <td width="30%">Customer</td>
                                        <td>:</td>
                                        <td>{{ $invoicecustomers->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>:</td>
                                        <td>{{ $invoicecustomers->user->address }}</td>
                                    </tr>
                                    <tr>
                                        <td>No. Hp</td>
                                        <td>:</td>
                                        <td>{{ $invoicecustomers->user->no_hp }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>:</td>
                                        <td>{{ $invoicecustomers->user->email }}</td>
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
                                        <td>Alamat </td>
                                        <td>:</td>
                                        <td>Pelem Lor No.50 Bantul Yogyakarta</td>
                                    </tr>
                                    <tr>
                                        <td>Telepon</td>
                                        <td>:</td>
                                        <td> 0274-4436047</td>
                                    </tr>
                                    <tr>
                                        <td>Tempo</td>
                                        <td>:</td>
                                        <td> {{ date('Y-m-d H:i:s', time() + (60*60*24*30)) }}</td>
                                    </tr>
                                 
                                        
                            
                                </table>
                            </div> --}}
                     
                            
                            <div class="col-md-6">
                                <form action="{{ route('invoicecustomer.update', ['id' => $invoicecustomers->id]) }}" method="post">
                                    @csrf
                                <div class="form-group">
                                    <br/>
                                    <label for="">Product</label>
                                    <input type="hidden" name="_method" value="PUT" class="form-control">
                                    <select name="product_customer_detail_id" id="product_ajax" class="form-control">
                                        <option value="">Pilih Produk</option>
                                        @foreach ($detailcustomers as $detail)
                                        @if($detail->user_id == $invoicecustomers->user_id)
                                        <option value="{{ $detail->id }}"> {{ $detail->product->title}}
                                        </option>
                                        @endif
                                        @endforeach
                                      
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Jumlah</label>
                                    <div id="qtyProduct"></div>
                                    <input type="number" id="qty" name="qty" class="form-control" placeholder="0" min="0">                        
                                </div>
                                <div class="form-group">
                                    <input type="hidden" value="{{ date('Y-m-d H:i:s', time() + (60*60*24*31)) }}" name="tempo" class="form-control" >
                                </div>
                                <input type="hidden" name="diskon" class="form-control" value="0">
                                <div class="form-group">
                                    <input type="hidden" value="{{ Auth::user()->id }}" name="user_id" class="form-control" >
                                </div>
                                <div class="form-group" style="display: none">
                                    <label for="">Status Pembayaran</label>
                                    <input type="hidden" name="status" id="status" value="Menunggu Pembayaran">
                                    <span id="status_display">Menunggu Pembayaran</span>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block" 
                                    >Checkout</button>
                                </div>
                            </div>
                            </form>
                            
                            
                            <!-- MENAMPILKAN TOTAL & TAX -->
                            {{-- <div class="col-md-4 offset-md-8">
                                <table class="table table-hover table-bordered">
                                    <tr>
                                        <td>Sub Total</td>
                                        <td>:</td>
                                        <td>Rp {{ number_format($invoicecustomers->total) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tax</td>
                                        <td>:</td>
                                        <td>11% (Rp {{ number_format($invoicecustomers->tax) }})</td>
                                    </tr>
                                    <tr>
                                        <td>Total Price</td>
                                        <td>:</td>
                                        <td>Rp {{ number_format($invoicecustomers->total_price) }}</td>
                                    </tr>
                                </table>
                            </div> --}}
                            <!-- MENAMPILKAN TOTAL & TAX -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    @php $no = 1 @endphp
                    @foreach ($invoicecustomers->detail_customer as $detail)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">#{{ $no++ }}</h5>
                                    <p class="card-text"><strong>Produk:</strong> {{ $detail->product_customer_detail->product->title }}</p>
                                    <p class="card-text"><strong>Jumlah:</strong> {{ $detail->qty }}</p>
                                    <p class="card-text"><strong>Harga:</strong> Rp {{ number_format($detail->price) }}</p>
                                    <p class="card-text"><strong>Diskon:</strong> Rp {{ number_format($detail->diskon) }}</p>
                                    <p class="card-text"><strong>Subtotal:</strong> Rp {{ $detail->subtotal }}</p>
                                    <form action="{{ route('invoicecustomer.delete_product', ['id' => $detail->id]) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE" class="form-control">
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus produk ini?')">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
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
                    url: '/api/product/customer/' + id,
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
        function updateStatusAndCheckout() {
        document.getElementById('status').value = 'Menunggu Pembayaran';
        document.getElementById('status_display').innerText = 'Menunggu Pembayaran';
        // (Tambahkan logika lain yang diperlukan sebelum melakukan checkout, jika ada)
    }
        </script>
@endsection