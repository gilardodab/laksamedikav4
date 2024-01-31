@extends('layouts.master')

@section('content')
@include('layouts.topNavBack')
{{-- @include('layouts.maintenance') --}}
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <b class="card-title">My Invoice PPN</b>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {!! session('success') !!}
                            </div>
                        @endif
                        <table class="table table-hover table-bordered" id="myppn-table" class="table" cellspacing="0" width="100%">

                            <thead>
                                <tr>
                                    <th>No Invoice</th>
                                    <th>Nama</th>
                                    <th>Marketing</th>
                                    <th>Total Item</th>
                                    <th>Subtotal</th>
                                    <th>Tax</th>
                                    <th>Total</th>
                                    <th><center>Print</center></th>
                                    <th><center>Edit</center></th>
                                    <th><center>Hapus</center></th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @if ($invoice->user->id == Auth::user()->id) --}}
                                @foreach ($invoiceppn as $invoices)
                                @if ($invoices->user->id == Auth::user()->id)
                                    <tr>
                                        <td><strong>{{ $invoices->no_faktur_2023 }}</strong></td>
                                        <td>{{ $invoices->customer->name }}</td>
                                        <td>{{ $invoices->user->name }}</td>
                                        <td><span class="badge badge-success">{{ $invoices->detailppn->count() }} Item</span></td>
                                        <td>Rp {{ number_format($invoices->total) }}</td>
                                        <td>Rp {{ number_format($invoices->tax) }}</td>
                                        <td>Rp {{ number_format($invoices->total_price) }}</td>
                                        <td> 
                                            <form class="btn-group" action="{{ route('invoiceppn.destroy', $invoices->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <a href="{{ route('invoiceppn.print', $invoices->id) }}" class="btn btn-secondary btn-sm"><i class="mdi mdi-printer"></i></a>
                                            </form>
                                        </td>
                                        <td>
                                            <form class="btn-group" action="{{ route('invoiceppn.destroy', $invoices->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <a href="{{ route('invoiceppn.edit', $invoices->id) }}" class="btn btn-warning btn-sm"><i class="mdi mdi-pencil"></i></a>
                                            </form>      
                                        </td>
                                        <td>
                                            <form class="btn-group" action="{{ route('invoiceppn.destroy', $invoices->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus faktur ini?')"><i class="mdi mdi-trash-can"></i></button>
                                            </form>
                                        </td>
                                        <td> 
                                            <a href="{{ route('invoiceppn.status', $invoices->id) }}" class="btn btn-primary btn-sm" onclick="return confirm('Anda yakin faktur ini sudah lunas?')">Lunas</a>
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
                            {{ $invoiceppn->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection