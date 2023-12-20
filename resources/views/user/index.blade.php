@extends('layouts.master')
@section('content')
@include('layouts.topNavBack')
<div class="container-xl px-4 mt-4">
    <!-- Account page navigation-->
    {{-- <nav class="nav nav-borders">
        <a class="nav-link active ms-0" href="https://www.bootdey.com/snippets/view/bs5-edit-profile-account-details" target="__blank">Profile</a>
        <a class="nav-link" href="https://www.bootdey.com/snippets/view/bs5-profile-billing-page" target="__blank">Billing</a>
        <a class="nav-link" href="https://www.bootdey.com/snippets/view/bs5-profile-security-page" target="__blank">Security</a>
        <a class="nav-link" href="https://www.bootdey.com/snippets/view/bs5-edit-notifications-page"  target="__blank">Notifications</a>
    </nav> --}}
    <form action="{{ route('user.update', $user->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        {{ method_field('PUT') }}
        @if (session('success'))
            <div class="alert alert-success">
             {!! session('success') !!}
             </div>
        @endif
    <hr class="mt-0 mb-4">
    <div class="row">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Profile Picture</div>
                <div class="card-body text-center">
                    <!-- Profile picture image-->
                    @if(empty(Auth::user()->foto))
                    <img class="img-account-profile rounded mb-2" src="{{ URL::asset('asset/img/avatar.png') }}" alt="" width="200px">
                    @else
                    <img class="img-account-profile rounded mb-2" src="{{ URL::asset('images/'.$user->foto) }}" alt="" width="200px">
                    @endif
                    <!-- Profile picture help block-->
                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                    <!-- Profile picture upload button-->
                    <input type="file" name="foto">
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Account Details</div>
                <div class="card-body">
                  
                        <!-- Form Group (username)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Name</label>
                            <input class="form-control" id="inputUsername" type="text" name="name" value="{{ $user->name }}">
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputLevel">Role</label>
                            <input class="form-control" id="inputLevel" type="text" name="level" value="{{ $user->level }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputMarketing">Marketing</label>
                            <input class="form-control" id="inputMarketing" type="text" name="marketing" value="{{ $user->marketing }}">
                        </div>
                        <div class="mb-3">
                            <label for="">Jenis Institusi</label>
                            <select id="jenis_institusi" name="jenis_institusi" class="form-control" value="">
                            @if ($user->jenis_institusi == 11)
                            <option value="">JENIS INSTITUSI NON PMI</option>
                            @else
                            <option value="">JENIS INSTITUSI PMI</option>
                            @endif
                           </select>
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputNohp">No Hp</label>
                            <input class="form-control" id="inputNohp" type="text" name="no_hp" value="{{ $user->no_hp }}">
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputAdress">Address</label>
                            <input class="form-control" id="inputAddress" type="text" name="address" value="{{ $user->address }}">
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmailAddress">Email address</label>
                            <input class="form-control" id="inputEmailAddress" type="email" name="email" value="{{ $user->email }}">
                        </div>
                        <!-- Save changes button-->
                        <input class="btn btn-primary btn-block btn-sm" type="submit" value="Save changes">
                    
                </div>
            </div>
        </div>
    </div>
</form>
</div>
@endsection