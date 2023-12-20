@extends('layouts.master')

@section('content')
@include('layouts.topNavBack')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12">
                                <b class="card-title">Add Invoice PPN</b>
                            </div><br>
                            <div class="col-md-6">
                                <form action="#" method="GET" class="form-inline">
                                    <input class="form-control mr-sm-2" id="search" name="cari" type="search" placeholder="Search" aria-label="Search">
                                    <img id="loader" src="{{asset('assets/images/loading.gif')}}" width="25" alt=""
                                    style="display:none">
                                    </form>
                            </div>
                        </div>
                    </div>
                            <div class="card-body">
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                            
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($customers as $customer)
                                    <tr>
                                        <td>{{ $customer->name }}</td>
                                        <td>
                                            <form action="{{ route('invoiceppn.store') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="customer_id" value="{{ $customer->id }}" class="form-control">
                                                <button class="btn btn-primary btn-sm">Add Invoice</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td class="text-center" colspan="5">Empty Data</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                            <div class="float-right">
                                {{ $customers->links() }}
                            </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#search').keyup(function() {
            $('#loader').show()
            search();
        });
        
        function search() {
            let keyword = $('#search').val();
            $.ajax({
                url: "{{url('/invoiceppn/cari/createppn/')}}",
                method: 'get',
                data: {
                    cari: keyword
                }
            }).done(function(data) {
                console.log(data)
                table_post_row(data)
            })
        }
        
        function table_post_row(res) {
            let htmlView = '';
            if (res.data.length <= 0) {
                htmlView += `
               <tr>
                  <td colspan="4">No data.</td>
              </tr>`;
            }
            for (let i = 0; i < res.data.length; i++) {
                htmlView += `
                <tr>
                    <td>` + res.data[i].name + `</td>
                    <td>` + `
                        <form class="btn-group" action="{{ route('invoiceppn.store') }}"
                            method="POST">
                            @csrf
                            <input type="hidden" name="customer_id" value="`+ res.data[i].id +`" class="form-control">
                            <button class="btn btn-primary btn-sm">Add Invoice</button>
                        </form>
                            ` + `</td>
                </tr>`;
            }
            $('tbody').html(htmlView);
            $('#loader').hide()
        
        }
        </script>
@endsection

