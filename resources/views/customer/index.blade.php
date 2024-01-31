@extends('layouts.master')
@section('content')
@include('layouts.topNavBack')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <b class="card-title">Data Customer</b>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ url('/customer/new') }}" class="btn btn-primary btn-sm float-right">Tambah Customer</a>
                            </div>
                            <div class="col-md-6">
                                <form action="#" method="GET" class="form-inline">
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
                        <table  class="table table-hover table-bordered" id="customers-table" class="table" cellspacing="0" width="100%">

                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    {{-- <th>Phone</th> --}}
                                    <th>Alamat</th>
                                    {{-- <th>Email</th> --}}
                                    <td >Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($customers as $customer)
                                <tr>
                                    <td>{{ $customer->name }}</td>
                                    {{-- <td>{{ $customer->phone }}</td> --}}
                                    <td>{{ \Illuminate\Support\Str::limit($customer->address, 50) }}</td>
                                    {{-- <td><a href="mailto:{{ $customer->email }}">{{ $customer->email }}</a></td> --}}
                                    <td>
                                        <form class="btn-group" action="{{ url('/customer/' . $customer->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE" class="form-control">
                                            <a href="{{ url('/customer/' . $customer->id) }}" class="btn btn-warning btn-sm"><i class="mdi mdi-pencil"></i></a>
                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus Customer ini?')"><i class="mdi mdi-trash-can"></i></button>
                                        </form>
                                    </td>
                                    {{-- <td>
                                        <form action="{{ route('invoice.store') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="customer_id" value="{{ $customer->id }}" class="form-control">
                                            <button class="btn btn-primary btn-sm">Add Invoice</button>
                                        </form>
                                    </td> --}}
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="5">Empty Data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection