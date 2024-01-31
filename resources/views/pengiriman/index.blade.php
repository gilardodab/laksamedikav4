@extends('layouts.master')

@section('content')
@include('layouts.topNavBack')

<div class="section full mt-2">
        <div class="section-title">Pengiriman</div>
        {{-- <div class="content-header mb-05">Make time by adding <code>.time</code> and times.</div> --}}
                   @foreach($pengirimans as $pengiriman)
        <div class="wide-block">
            <!-- timeline -->
 
            <div class="timeline timed">
                <div class="item">
                    <span class="time"> {{ $pengiriman->created_at}}</span>
                    <div class="dot bg-success"></div>
                    <div class="content">
                        <h4 class="title">Invoice : {{ $pengiriman->invoice_id }}</h4>
                        <div class="text">Qty : {{ $pengiriman->qty }}</div>
                        <div class="text">Status : {{ $pengiriman->status}}</div>
                        
                        @if ($pengiriman->status === 'Dikirim')
                        <div class="text">Dikirim</div>
                    @endif
                    </div>
                </div>
                {{-- <div class="item">
                    <span class="time">1:30 PM</span>
                    <div class="dot bg-danger"></div>
                    <div class="content">
                        <h4 class="title">Meet up</h4>
                        <div class="text">
                            <img src="assets/img/sample/avatar/avatar3.jpg" alt="avatar" class="imaged w24 rounded">
                            <img src="assets/img/sample/avatar/avatar4.jpg" alt="avatar" class="imaged w24 rounded">
                            <img src="assets/img/sample/avatar/avatar5.jpg" alt="avatar" class="imaged w24 rounded">
                            <img src="assets/img/sample/avatar/avatar7.jpg" alt="avatar" class="imaged w24 rounded">
                        </div>
                    </div>
                </div>
                <div class="item">
                    <span class="time">04:40 PM</span>
                    <div class="dot bg-warning"></div>
                    <div class="content">
                        <h4 class="title">Party Night</h4>
                        <div class="text">Get a ticket for party at tonight 9:00 PM</div>
                    </div>
                </div>
                <div class="item">
                    <span class="time">06:00 PM</span>
                    <div class="dot bg-info"></div>
                    <div class="content">
                        <h4 class="title">New Release</h4>
                        <div class="text">Export the version 2.3</div>
                    </div>
                </div> --}}
            </div>
            <!-- * timeline -->
            @endforeach
        </div>

    </div>
    @endsection

