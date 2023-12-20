@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <b class="card-title">Add Soal</b>
                    </div>
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{ url('/soal') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Topik Pembahasan</label>
                                <input type="text" name="topik" class="form-control {{ $errors->has('topik') ? 'is-invalid':'' }}" placeholder="Contoh : Hematology Analyzer">
                                <p class="text-danger">{{ $errors->first('topik') }}</p>
                            </div>
                            <div class="form-group">
                                @csrf
                                <label for="">Nama Karyawan</label>
                                <select class="select2 form-control" id="user_id" name="user_id" class="form-control">
                                    <option value="">-- Select --</option>
                                    @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->email }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="btn btn-primary btn-sm">Tambah Topik</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('#user_id').select2();
        });
    </script>
    
@endsection
