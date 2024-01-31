@extends('layouts.master')

@section('content')
@include('layouts.topNavBack')
    <div class="container">
        <div class="row " >
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <b class="card-title">Daftar Produk</b>
                            </div>
                            {{-- @if(auth()->user()->level=="") --}}
                            <div class="col-md-6">
                                <a href="{{ url('/product/new') }}" class="btn btn-primary btn-sm float-right"><i class="mdi mdi-plus-box mdi-18px"></i>Produk</a>
                            </div>
                            {{-- @endif --}}
                            <div class="col-md-6">
                                <form action="" method="GET" class="form-inline">
                                  <input class="form-control mr-sm-2" id="search" name="cari" type="search" placeholder="Search" aria-label="Search" value="{{ old('cari') }}">
                                  <img id="loader" src="{{asset('assets/images/loading.gif')}}" width="25" alt=""
                                    style="display:none">
                                </form>
                            </div>                       
                    
                    </div>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {!! session('success') !!}
                            </div>
                        @endif
                        <table class="table table-hover table-bordered" id="produk-table" class="table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <!--<th>Nama Outlet</th>-->
                                    {{-- <th>Price</th> --}}
                                    <th>Stok</th>
                                    {{-- <th>Date</th> --}}
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- DIRECTIVE FORELSE SAMA DENGAN FOREACH -->
                                <!-- HANYA SAJA SUDAH FORELSE SUDAH DILENGKAPI FUNGSI UNTUK MENGECEK DATA ADA ATAU TIDAK SEHINGGA KITA TIDAK PERLU LAGI MENGGUNAKAN IF CONDITION -->
                                <!-- JIKA DATA KOSONG MAKA FUNGSI YANG BERJALAN ADALAH CODE BERADA PADA BLOCK CODE @3MPTY -->
                                @forelse($products as $product)
                                <tr>
                                    <!-- MENAMPILKAN VALUE DARI TITLE -->
                                    <td>{{ $product->title }}</td>
                                    {{-- <!--<td>{{ $product->customer['name'] }}</td>--> --}}
                                    {{-- <td>Rp {{ number_format($product->price) }}</td> --}}
                                    <td>{{ $product->stock }}</td>
                                    {{-- <td>{{ $product->created_at->format('d-m-Y') }}</td> --}}
                                    <!-- TOMBOL DELETE MENGGUNAKAN METHOD DELETE DALAM ROUTING SEHINGGA KITA MEMASUKKAN TOMBOL TERSEBUT KEDALAM TAG <FORM></FORM> -->
                                    <td>
                                        <form class="btn-group" action="{{ url('/product/' . $product->id) }}" method="POST">
                                            <!-- @csrf ADALAH DIRECTIVE UNTUK MEN-GENERATE TOKEN CSRF -->
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE" class="form-control">
                                            <a href="{{ url('/product/' . $product->id) }}" class="btn btn-warning btn-sm"><i class="mdi mdi-pencil"></i></a>
                                            <a href="{{ url('/product/detail/' . $product->id) }}" class="btn btn-success btn-sm"><i class="mdi mdi-account-plus"></i></a>
                                            <a href="{{ url('/product/lihat/detail/' . $product->id) }}" class="btn btn-primary btn-sm"><i class="mdi mdi-account-eye"></i></a>
                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus produk ini?')"><i class="mdi mdi-trash-can"></i></button>
                                        </form>
                                        {{-- <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalStock{{ $product->id }}"> --}}
                                            <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modalStock{{ $product->id }}">
                                                <i class="mdi mdi-loupe"></i>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="6">Empty Data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{-- <div class="float-right">
                            {{ $products->links() }}
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#search').keyup(function() {
            $('#loader').show()
            search();
        });
        
        function search() {
            let keyword = $('#search').val();
            $.ajax({
                url: "{{route('product.cari')}}",
                method: 'get',
                data: {
                    cari: keyword
                }
            }).done(function(data) {
                table_post_row(data)
            })
        }
        
        function table_post_row(res) {
            let htmlView = '';
            if (res.data.length <= 0) {
                htmlView += `
               <tr>
                  <td colspan="4">No data.</td>
              </tr>`;
            }
            for (let i = 0; i < res.data.length; i++) {
                htmlView += `
                <tr>
                    <td>` + res.data[i].title + `</td>
                    <td>` + res.data[i].stock + `</td>
                    <td>` + `
                        <form class="btn-group" action="/product/` + res.data[i].id + `"
                            method="POST">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE" class="form-control">
                            <a href="/product/` + res.data[i].id + `"
                                class="btn btn-warning btn-sm"><i class="mdi mdi-pencil"></i></a>
                            <a href="/product/detail/` + res.data[i].id + `"
                                class="btn btn-success btn-sm"><i class="mdi mdi-account-plus"></i></a>
                            <a href="/product/lihat/detail/` + res.data[i].id + `"
                                class="btn btn-primary btn-sm"><i class="mdi mdi-account-eye"></i></a>
                            <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Anda yakin ingin menghapus produk ini?')"><i
                                    class="mdi mdi-trash-can"></i></button>
                        </form>
                        <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal"
                            data-target="#modalStock` + res.data[i].id + `">
                            <i class="mdi mdi-database-plus"></i>
                        </button>
                            ` + `</td>
                </tr>`;
            }
            $('tbody').html(htmlView);
            $('#loader').hide()
        
        }
        </script>
@foreach ($products as $data)
@include('products.stock')  
@endforeach
@endsection

 