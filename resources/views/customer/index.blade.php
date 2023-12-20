@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <b class="card-title">Customer</b>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ url('/customer/new') }}" class="btn btn-primary btn-sm float-right">Add Customer</a>
                            </div>
                            <div class="col-md-6">
                                <form action="#" method="GET" class="form-inline">
                                  <input class="form-control mr-sm-2" id="search" name="cari" type="search" placeholder="Search" aria-label="Search" value="{{ old('cari') }}">
                                  <img id="loader" src="{{asset('assets/images/loading.gif')}}" width="25" alt=""
                                    style="display:none">
                                </form>
                        </div>
                    </div>
                        </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {!! session('success') !!}
                            </div>
                        @endif
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    {{-- <th>Phone</th> --}}
                                    <th>Address</th>
                                    {{-- <th>Email</th> --}}
                                    <td colspan="2"><b><center>Action</center></b></td>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($customers as $customer)
                                <tr>
                                    <td>{{ $customer->name }}</td>
                                    {{-- <td>{{ $customer->phone }}</td> --}}
                                    <td>{{ \Illuminate\Support\Str::limit($customer->address, 50) }}</td>
                                    {{-- <td><a href="mailto:{{ $customer->email }}">{{ $customer->email }}</a></td> --}}
                                    <td>
                                        <form class="btn-group" action="{{ url('/customer/' . $customer->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE" class="form-control">
                                            <a href="{{ url('/customer/' . $customer->id) }}" class="btn btn-warning btn-sm"><i class="mdi mdi-pencil"></i></a>
                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus Customer ini?')"><i class="mdi mdi-trash-can"></i></button>
                                        </form>
                                    </td>
                                    {{-- <td>
                                        <form action="{{ route('invoice.store') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="customer_id" value="{{ $customer->id }}" class="form-control">
                                            <button class="btn btn-primary btn-sm">Add Invoice</button>
                                        </form>
                                    </td> --}}
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="5">Empty Data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="float-right">
                            {{ $customers->links() }}
                        </div>
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
                url: "{{route('customer.cari')}}",
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
                    <td>` + res.data[i].address + `</td>
                    <td>` + `
                        <form class="btn-group" action="/customer/` + res.data[i].id + `"
                            method="POST">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE" class="form-control">
                            <a href="/customer/` + res.data[i].id + `"
                                class="btn btn-warning btn-sm"><i class="mdi mdi-pencil"></i></a>
                            <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Anda yakin ingin menghapus customer ini?')"><i
                                    class="mdi mdi-trash-can"></i></button>
                        </form>
                            ` + `</td>
                </tr>`;
            }
            $('tbody').html(htmlView);
            $('#loader').hide()
        
        }
        </script>
@endsection