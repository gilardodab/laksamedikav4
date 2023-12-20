@extends('layouts.master')

@section('content')
@include('layouts.topNavBack')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <b class="card-title">Edit Detail Reguler</b>
                </div>
                <div class="card-body">
                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif

                    <form action="{{ route('update.detail', $details->id) }}" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="PUT" class="form-control">
                        <div class="card">
                            <div class="card-body">
                                <b style="font-size: 20px; color:green;">{{$details->product->title}}</b>
                            </div>
                          </div>
                        <div class="form-group">
                            <label for="">Price</label>
                            <input type="number" name="price"
                                class="form-control {{ $errors->has('price') ? 'is-invalid':''  }}" placeholder="Price" value="{{ $details->price }}">
                            <p class="text-danger">{{ $errors->first('price') }} </p>
                        </div>
                            <div class="form-group">
                             @csrf
                             <label for="">Customer</label>
                             <select id="customer_id" name="customer_id" class="form-control" value="">
                             <option value="">--Pilih Customer--</option>
                             @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}" {{ $customer->id==$details->customer_id ? 'selected':'' }}>{{ $customer->name }} - {{ $customer->email }}</option>
                             @endforeach
                            </select>
                            </div>
                        <div class="form-group">
                            <button class="btn btn-success btn-sm">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection