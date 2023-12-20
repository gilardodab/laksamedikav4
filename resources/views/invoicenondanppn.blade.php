@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12">
                                <b class="card-title">Add Invoice</b>
                            </div>
                        </div>
                    </div>
                            <div class="card-body">
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                            
                                <div class="row">
                                    <div class="col-sm-6">
                                      <div class="card">
                                        <div class="card-body">
                                          <h5 class="card-title">NON PPN</h5>
                                          <p class="card-text">Buat Faktur NON PPN</p>
                                          @if (!$invoice->isEmpty())
                                          <a href="#" id="kosong" class="btn btn-primary">ADD INVOICE</a>
                                          @else
                                          <a href="{{ route('invoice.create') }}" class="btn btn-primary">ADD INVOICE</a>
                                          @endif
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-sm-6">
                                      <div class="card">
                                        <div class="card-body">
                                          <h5 class="card-title">PPN</h5>
                                          <p class="card-text">Buat Faktur PPN</p>
                                          @if (!$invoiceppn->isEmpty())
                                          <a href="#" id="kosongppn" class="btn btn-primary">ADD INVOICE</a>
                                          @else
                                          <a href="{{ route('invoiceppn.create') }}" class="btn btn-primary">ADD INVOICE PPN</a>
                                          @endif
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

    <script>
      $('#kosong').click(function(){
        alert('Ada faktur non ppn yang belum selesai!')
      })
      $('#kosongppn').click(function(){
        alert('Ada faktur ppn yang belum selesai!')
      })
    </script>
@endsection

