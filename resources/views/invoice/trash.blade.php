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
                                <b class="card-title">Faktur Lunas</b>
                            </div>
                        </div>
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
                                    <th>Invoice ID</th>
                                    <th>Name</th>
                                    {{-- <th>Phone</th> --}}
                                    <th>Total Item</th>
                                    <th>Subtotal</th>
                                    <th>Tax</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($invoice as $row)
                                    <tr>
                                        <td><strong>{{ $row->id }}</strong></td>
                                        <td>{{ $row->customer->name }}</td>
                                        {{-- <td>{{ $row->customer->phone }}</td> --}}
                                        <td><span class="badge badge-success">{{ $row->detail->count() }} Item</span></td>
                                        <td>Rp {{ number_format($row->total) }}</td>
                                        <td>Rp {{ number_format($row->tax) }}</td>
                                        <td>Rp {{ number_format($row->total_price) }}</td>
                                        <td> 
                                            <a href="#" class="btn btn-warning btn-sm">Lunas</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Empty Data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="float-right">
                            {{ $invoice->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection