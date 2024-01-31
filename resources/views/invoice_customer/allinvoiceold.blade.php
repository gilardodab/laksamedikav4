@extends('layouts.master')

@section('content')
@include('layouts.topNavBack')
    <div class="container">
        <div class="row" style="margin-bottom: 3cm; margin-top: 2cm;">
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
                        <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="allinvoice-table" class="table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No Invoice</th>
                                    <th>Name</th>
                                    <th>Total Item</th>
                                    <th>Subtotal</th>
                                    <th>Tax</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
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
                                        <td><strong>
                                            <a href="{{ $invoicecustomers->id }}" data-toggle="modal" data-target="#transaksiModal{{ $invoicecustomers->id }}">{{ $invoicecustomers->status }}</a>
                                            </strong></td>
 
                                        
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
                                                                                         <!-- Button for editing status -->
                                            {{-- <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editStatusModal{{ $invoicecustomers->id }}">Edit Status</button> --}}

                                        </td>
                                        {{-- <td> 
                                            <a href="{{ route('invoice.status', $invoicecustomers->id) }}" class="btn btn-primary btn-sm" onclick="return confirm('Anda yakin faktur ini sudah lunas?')">Lunas</a>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @foreach ($invoicecustomerall as $invoicecustomers)
                            <div class="modal fade" id="transaksiModal{{ $invoicecustomers->id }}" tabindex="-1" role="dialog" aria-labelledby="transaksiModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header" style="display: block">
                                            <h5 class="modal-title" id="transaksiModalLabel">Pembayaran Invoice #{{ $invoicecustomers->no_faktur }}</h5>
                                            <h5 class="modal-title" id="transaksiModalLabel">Nama :{{ $invoicecustomers->user->name }}</h5>
                                            
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            
                                            @if ($invoicecustomers->photo_path)
                                            <img src="{{ route('photo.show', $invoicecustomers->id) }}" alt="Invoice Photo" style="max-width: 200px;">
                                            
                                        @else
                                            No Photo
                                        @endif
                                        <form action="{{ route('invoicecustomer.updateStatus', $invoicecustomers->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select class="form-control" id="status" name="status">
                                                    <option value="Disetujui" {{ $invoicecustomers->status === 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                                                    <option value="Ditolak" {{ $invoicecustomers->status === 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-sm">Update Status</button>
                                        </form>    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @foreach ($invoicecustomerall as $invoicecustomers)
                        <!-- Modal for editing status -->
                            <div class="modal fade" id="editStatusModal{{ $invoicecustomers->id }}" tabindex="-1" role="dialog" aria-labelledby="editStatusModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editStatusModalLabel">Edit Status Invoice {{ $invoicecustomers->no_faktur }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Card displaying the invoice number -->
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title">No Invoice: {{ $invoicecustomers->no_faktur }}</h5>
                                                </div>
                                            </div>

                                            <!-- Form for updating status -->
                                            <form action="{{ route('invoicecustomer.updateStatus', $invoicecustomers->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label for="status">Status</label>
                                                    <select class="form-control" id="status" name="status">
                                                        <option value="Disetujui" {{ $invoicecustomers->status === 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                                                        <option value="Ditolak" {{ $invoicecustomers->status === 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Update Status</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        <script> 
                        $(document).ready(function() {
                                $('#allinvoice-table').DataTable( {
                                    "order": [[ 0, "desc" ]]
                                } );
                            } );
                            $(document).ready(function () {
                                $('#allinvoice-table').DataTable();
                                });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
