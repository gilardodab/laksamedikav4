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
                                <b class="card-title"> Invoice</b>
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
                                    <th>Nama</th>
                                    <th>Marketing</th>
                                    <th>Total Item</th>
                                    <th>Subtotal</th>
                                    <th>Tax</th>
                                    <th>Total Price</th>
                                    <th><center>Aksi</center></th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @if ($invoice->user->id == Auth::user()->id) --}}
                                @foreach ($invoice as $invoices)
                                @if ($invoices->user->id == Auth::user()->id)
                                    <tr>
                                        <td><strong>{{ $invoices->no_faktur_2023 }}</strong></td>
                                        <td>{{ $invoices->customer->name }}</td>
                                        <td>{{ $invoices->user->name }}</td>
                                        <td><span class="badge badge-success">{{ $invoices->detail->count() }} Item</span></td>
                                        <td>Rp {{ number_format($invoices->total) }}</td>
                                        <td>Rp {{ number_format($invoices->tax) }}</td>
                                        <td>Rp {{ number_format($invoices->total_price) }}</td>
                                        <td>
                                            <form class="btn-group" action="{{ route('invoice.destroy', $invoices->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <a href="{{ route('invoice.print', $invoices->id) }}" class="btn btn-secondary btn-sm"><i class="mdi mdi-printer"></i></a>
                                                <a href="{{ route('invoice.edit', $invoices->id) }}" class="btn btn-warning btn-sm"><i class="mdi mdi-pencil"></i></a>
                                                <a href="{{ route('invoice.print2', $invoices->id) }}" class="btn btn-success btn-sm"><i class="mdi mdi-printer"></i></a>
                                                <button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus faktur ini?')"><i class="mdi mdi-trash-can"></i></button>
                                            </form>
                                        </td>
                                        <td> 
                                            <a href="{{ route('invoice.status', $invoices->id) }}" class="btn btn-primary btn-sm" onclick="return confirm('Anda yakin faktur ini sudah lunas?')">Lunas</a>
                                        </td>
                                    </tr>
                                  
                                  {{-- <script>window.location = "/invoice/public/invoice/invoice/all";</script> --}}
                                  {{-- <a href="{{ route('invoice.allinvoice') }}"></a> --}}
                                {{-- @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Empty Data</td>
                                    </tr> --}}
                                    @endif
                                @endforeach
                                    {{-- @endif --}}
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