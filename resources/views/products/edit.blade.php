@extends('layouts.master')

@section('content')
@include('layouts.topNavBack')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <b class="card-title">Update Product</b>
                    </div>
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
						
                        <!-- ACTION MENGARAH KE /product/id -->
                        <form action="{{ url('/product/' . $product->id) }}" method="post">
                            @csrf
                            <!-- KARENA METHOD YANG AKAN DIGUNAKAN ADALAH PUT -->
                            <!-- MAKA KITA PERLU MENGIRIMKAN PARAMETER DENGAN NAME _method -->
                            <!-- DAN VALUE PUT -->
                            <input type="hidden" name="_method" value="PUT" class="form-control">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="title" class="form-control" value="{{ $product->title }}" placeholder="Masukkan nama produk">
                            </div>
                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea name="description" cols="10" rows="10" class="form-control">{{ $product->description }}</textarea>
                            </div>
                            {{-- <div class="form-group">
                                <label for="">Price</label>
                                <input type="number" name="price" class="form-control" value="{{ $details->price }}">
                            </div> --}}
                            {{-- @if(auth()->user()->level=="superadmin") --}}
                            <div class="form-group">
                                <label for="">Stock</label>
                                <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" min="0">
                            </div>
                            {{-- @else
                            <div class="form-group">
                                <input type="text" name="stock" class="form-control" value="{{ $product->stock }}">
                            </div>
                            @endif --}}

                            {{-- <div class="form-group">
                            @csrf
                            <label for="">Customer</label>
                            <select id="customer_id" name="customer_id" class="form-control" value="">
                             @foreach ($customers as $customer)
                           <option value="{{ $customer->id }}" {{ $customer->id==$details->customer_id ? 'selected':'' }}>{{ $customer->name }} - {{ $customer->email }}</option>
                            @endforeach
                            </select>
                            </div> --}}
                            
                            <div class="form-group">
                                <button class="btn btn-primary btn-sm">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection