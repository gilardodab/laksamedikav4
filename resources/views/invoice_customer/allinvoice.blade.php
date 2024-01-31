@extends('layouts.master')



@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-12">

                <div class="card">

                    <div class="card-header">

                        <div class="row">

                            <div class="col-md-6">

                                <b class="card-title">Daftar Pesanan Customer</b>

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

                                    <th>No Invoice</th>

                                    <th>Name</th>

                                    <th>Total Item</th>

                                    <th>Subtotal</th>

                                    <th>Tax</th>

                                    <th>Total Price</th>

                                    <th><center>Action</center></th>

                                </tr>

                            </thead>

                            <tbody>

                                {{-- @if ($invoice->user->id == Auth::user()->id) --}}

                                @foreach ($invoicecustomerall as $invoicecustomers)

                                    <tr>

                                        <td><strong>{{ $invoicecustomers->no_faktur }}</strong></td>

                                        <td>{{ $invoicecustomers->user->name }}</td>

                                        <td><span class="badge badge-success">{{ $invoicecustomers->detail_customer->count() }} Item</span></td>

                                        <td>Rp {{ number_format($invoicecustomers->total) }}</td>

                                        <td>Rp {{ number_format($invoicecustomers->tax) }}</td>

                                        <td>Rp {{ number_format($invoicecustomers->total_price) }}</td>

                                        <td>

                                            <form class="btn-group" action="{{ route('invoicecustomer.destroy', $invoicecustomers->id) }}" method="POST">

                                                @csrf

                                                <input type="hidden" name="_method" value="DELETE">

                                                @if ($invoicecustomers->ppn != 0)

                                                <a href="{{ route('invoicecustomer.print', $invoicecustomers->id) }}" class="btn btn-secondary btn-sm"><i class="mdi mdi-printer"></i></a>

                                                @else

                                                <a href="{{ route('invoicecustomer.printnonppn', $invoicecustomers->id) }}" class="btn btn-success btn-sm"><i class="mdi mdi-printer"></i></a>

                                                @endif

                                                <a href="{{ route('invoicecustomer.edit', $invoicecustomers->id) }}" class="btn btn-warning btn-sm"><i class="mdi mdi-pencil"></i></a>

                                                <button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus faktur ini?')"><i class="mdi mdi-trash-can"></i></button>

                                            </form>

                                        </td>

                                        {{-- <td> 

                                            <a href="{{ route('invoice.status', $invoicecustomers->id) }}" class="btn btn-primary btn-sm" onclick="return confirm('Anda yakin faktur ini sudah lunas?')">Lunas</a>

                                        </td> --}}

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                        <div class="float-right">

                            {{ $invoicecustomerall->links() }}

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection