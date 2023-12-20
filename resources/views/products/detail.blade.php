@extends('layouts.master')

@section('content')
@include('layouts.topNavBack')
<div class="container">
    <div class="row" style="margin-top: 2cm; margin-bottom: 3cm">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <b class="card-title">Add Harga Reguler</b>
                </div>
                <div class="card-body">
                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif

                    <form action="{{ route('detail') }}" method="post">
                        @csrf
                        <div class="card">
                            <div class="alert alert-secondary" role="alert">
                                {{$products->title}}
                              </div>
                          </div>
                        <input type="hidden" name="product_id" value="{{$products->id}}">
                        <div class="form-group">
                            <label for="">Price</label>
                            <input type="number" name="price"
                                class="form-control {{ $errors->has('price') ? 'is-invalid':''  }}" placeholder="Price">
                            <p class="text-danger">{{ $errors->first('price') }}</p>
                        </div>
                        <div class="form-group">
                            @csrf
                            <label for="">Customer</label>
                            <select class="select1 form-control" id="customer_id" name="customer_id" class="form-control">
                                <option value="">-- Select --</option>
                                @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }} - {{ $customer->email }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success btn-sm">Save</button>
                        </div>
                    </form>

                    <script>
                        // In your Javascript (external .js resource or <script> tag)
                        $(document).ready(function() {
                            $('.select1').select2();
                        });
                    </script>
                    
                </div>


                <div class="card">
                    <div class="card-header">
                        <b class="card-title">Add Harga Customer</b>
                    </div>
                    <div class="card-body">    
                        <form action="{{ route('save.detail.customer') }}" method="post">
                            @csrf
                            <div class="card">
                                <div class="alert alert-secondary" role="alert">
                                    {{$products->title}}
                                  </div>
                              </div>
                            <input type="hidden" name="product_id" value="{{$products->id}}">
                            <div class="form-group">
                                <label for="">Price</label>
                                <input type="number" name="price"
                                    class="form-control {{ $errors->has('price') ? 'is-invalid':''  }}" placeholder="Price">
                                <p class="text-danger">{{ $errors->first('price') }}</p>
                            </div>
                            <div class="form-group">
                                @csrf
                                <label for="">Customer</label>
                                <select class="select2 form-control" id="user_id" name="user_id" class="form-control">
                                    <option value="">-- Select --</option>
                                    @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->email }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success btn-sm">Save</button>
                            </div>
                        </form>
    
                        <script>
                            // In your Javascript (external .js resource or <script> tag)
                            $(document).ready(function() {
                                $('#user_id').select2();
                            });
                        </script>
                        
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection