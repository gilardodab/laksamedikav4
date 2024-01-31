@extends('layouts.master')
@section('content')
@include('layouts.topNav')
<div class="section" id="user-section">
    <div id="user-detail">
        <div class="avatar">
            {{-- <img src="{{ URL::asset('asset/img/sample/avatar/avatar1.jpg')}}" alt="avatar" class="imaged w64 rounded"> --}}
            @if(empty(Auth::user()->foto))
                <img src="{{ URL::asset('asset/img/avatar.png') }}" alt="avatar" class="imaged w32 rounded">
            @else
                <img src="{{ URL::asset('images/'.Auth::user()->foto) }}" alt="avatar" class="imaged w32 rounded">
            @endif

        </div>
        <div id="user-info">
            <h4 id="user-name" >{{ Auth::user()->name }}</h4>
            <span id="user-role">{{ Auth::user()->level }}</span>
        </div>
    </div>
</div>

<div class="card">
    <div class="carousel-container">
        <div class="carousel">
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner ">
                        @foreach($sliders as $slider)
                            <div class="carousel-item @if($loop->first) active @endif">
                                <div class="slider-image text-center">
                                    <img src="{{ asset('images/slider/' . $slider->image) }}" alt="Slider Image" style="max-width: autopx;">
                                </div>
                            </div>
                            
                        @endforeach
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section" id="menu-section">
    <div class="card">
        <div class="card-body text-center">
            @if(Auth::check())
            @if(auth()->user()->level=="superadmin")

            <div class="list-menu">
                <div class="item-menu text-center">
                    <div class="menu-icon">                           
                        <a href="{{ url('menuorder') }}" class="orange" >
                            <ion-icon name="cart-sharp" size="large"></ion-icon>
                    </div>
                    <div class="menu-name">
                        
                        <span class="text-center" >Order</span>
                    </div></a>
                </div>
                {{-- <div class="item-menu ">
                    <a href="{{ url('menuorder') }}" class="black">
                    <button type="button" class="btn btn-icon btn-primary mr-1 mb-1 text-center">
                        <ion-icon name="document-text-outline"></ion-icon>
                    </button>
                
                    <div class="menu-name">
                        <span class="text-center">Order</span>
                    </div></a>
                </div> --}}
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="{{ url('product') }}" class="primary">
                            <ion-icon name="cube" size="large"></ion-icon>
                    </div>
                    <div class="menu-name">
                        <span class="text-center">Produk</span>
                    </div></a>
                </div>
                
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="{{ url('invoiceppn') }}" class="purple" >
                            <ion-icon name="document-text" size="large"></ion-icon>
                    </div>
                    <div class="menu-name">
                        <span class="text-center">Histori</span>
                    </div></a>
                </div>

                

                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="{{ url('invoiceppn') }}" class="purple" >
                            <ion-icon name="location-outline" size="large"></ion-icon>
                    </div>
                    <div class="menu-name">
                        <span class="text-center">Lacak</span>
                    </div> </a>
                </div>

                {{-- <div class="item">
                    <div class="icon">
                        <a href="" class="orange" style="font-size: 40px;">
                            <ion-icon name="location"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        Lokasi
                    </div>
                </div> --}}


                @elseif(auth()->user()->level=="admin")
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="{{ url('invoiceppn') }}" class="warning" >
                            <ion-icon name="file-tray-stacked-outline " size="large"></ion-icon>
                        
                    </div>
                    <div class="menu-name">
                        <span class="text-center">Stock</span>
                    </div></a>
                </div>
                
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="{{ url('invoiceppn') }}" class="warning" style="font-size: 40px;">
                            <ion-icon name="document-text"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        <span class="text-center">Histori</span>
                    </div>
                </div>
                
                @elseif(auth()->user()->level=="marketing")
                <div class="list-menu">
                    
                        <div class="item-menu text-center">
                            <div class="menu-icon">                           
                                <a href="{{ url('menuorder') }}" class="orange" >
                                    <ion-icon name="cart-sharp" size="large"></ion-icon>
                            </div>
                            <div class="menu-name">
                                
                                <span class="text-center" >Order</span>
                            </div></a>
                        </div>
                    
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="{{ url('invoiceppn') }}" class="purple" >
                                <ion-icon name="document-text" size="large"></ion-icon>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">MyInvoice</span>
                        </div></a>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">                           
                            <a href="{{ url('/brosur-user') }}" class="purple" style="font-size: 40px;">
                                <ion-icon name="reader-outline"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center" >Brosur</span>
                        </div>
                    </div>

                @elseif(auth()->user()->level=="gudang")
                <div class="list-menu ">
                    <div class="item-menu text-center">
                        <div class="menu-icon">                           
                            <a href="{{ url('/brosur-user') }}" class="purple" style="font-size: 40px;">
                                <ion-icon name="reader-outline"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center" >Brosur</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">                           
                            <a href="{{ url('/daftar-barang') }}" class="purple" style="font-size: 40px;">
                                <ion-icon name="hammer-outline"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center" >Barang</span>
                        </div>
                    </div>
                @elseif(auth()->user()->level=="customer")
                <div class="list-menu">
                    <div class="item-menu text-center">
                        <div class="menu-icon"> 
                            <form action="{{ route('invoicecustomer.store') }}" method="post">
                                @csrf
                                <input type="hidden" value="0" name="total" class="form-control" >
                                <!--<select class="form-control" name="ppn" aria-label="Default select example">-->
                                <!--    <option selected>Pilih NON PMI / PMI</option>-->
                                <!--    <option value="11">NON PMI</option>-->
                                <!--    <option value="0">PMI</option>-->
                                <!--  </select><br>-->
                                
                                  
                                {{-- @if (!$invoicecust->isEmpty())  
                                <div class="alert alert-danger" role="alert">
                                    Ada Faktur Belum Selesai!
                                  </div>                             
                                @else
                                    <button class="btn btn-primary btn-lg">Pesan</button>
                                @endif --}}
                                                 
                            {{-- <a href="{{url('customer-order')}}" class="purple" style="font-size: 40px;"> --}}
                                <a class="purple" style="font-size: 40px;">
                                
                                
                            </a>
                        </div>
                        <div class="menu-name">
                            <button class=" purple " style="
                            
                            margin-top: 0px;
                            padding-right: 42px;
                            padding-left: 0px;
                            border-top-width: 0px;
                            border-left-width: 0px;
                            border-right-width: 0px;
                            border-bottom-width: 0px;
                            height: 0px;
                            width: 0px;
                            padding-top: 0px;
                            padding-bottom: 0px;
                            
                            " 
                         ><ion-icon name="cart-sharp" style="font-size: 40px"></ion-icon></button>
                        </div></form> <span class="text-center">Order</span>    
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="{{ url('customer-order') }}" class="purple" style="font-size: 40px;">
                                <ion-icon name="document-text"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Histori</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">                           
                            <a href="{{ url('/sponsor-request/create') }}" class="purple" style="font-size: 40px;">
                                <ion-icon name="archive-outline"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center" >Sponsor</span>
                        </div>
                    </div>
                    
                    <div class="item-menu text-center">
                        <div class="menu-icon">                           
                            <a href="{{ url('/brosur-user') }}" class="purple" style="font-size: 40px;">
                                <ion-icon name="reader-outline"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center" >Brosur</span>
                        </div>
                    </div>
                @endif
                @endif
                
            </div>
        </div>
    
        <div class="card-body text-center">
            @if(Auth::check())
            @if(auth()->user()->level=="superadmin")
            <div class="list-menu">
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="{{ url('menuinvoice') }}" class="purple">
                            <ion-icon name="podium-outline" size="large"></ion-icon>
                        
                    </div>
                    <div class="menu-name">
                        <span class="text-center">All Invoice</span>
                    </div></a>
                </div>

                    <div class="item-menu text-center">
                        <div class="menu-icon">                           
                            <a href="{{ url('/sponsor-request/create') }}" class="purple" >
                                <ion-icon name="archive-outline" size="large"></ion-icon>
                            
                        </div>
                        <div class="menu-name">
                            <span class="text-center" >Sponsor</span>
                        </div></a>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">                           
                            <a href="{{ url('/brochures') }}" class="purple">
                                <ion-icon name="reader-outline" size="large"></ion-icon>
                            
                        </div>
                        <div class="menu-name">
                            <span class="text-center" >Brosur</span>
                        </div></a>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">                           
                            <a href="{{ url('/penawaran') }}" class="purple">
                                <ion-icon name="trending-down-outline" size="large"></ion-icon>
                        </div>
                        <div class="menu-name">
                            <span class="text-center" >Penawaran</span>
                        </div></a>
                    </div>
                    
                {{-- <div class="item-menu text-center">
                    <div class="menu-icon">                           
                        <a href="{{ url('/add/nondanppn') }}" class="purple" style="font-size: 40px;">
                            <ion-icon name="list"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        <span class="text-center" >Penawaran</span>
                    </div>
                </div>

                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="{{ url('product') }}" class="purple" style="font-size: 40px;">
                            <ion-icon name="calendar-outline"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        <span class="text-center">Daily Report</span>
                    </div>
                </div>
                
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="{{ url('invoiceppn') }}" class="purple" style="font-size: 40px;">
                            <ion-icon name="document-text"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        <span class="text-center">Laporan</span>
                    </div>
                </div> --}}



                {{-- @elseif(auth()->user()->level=="admin")
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="{{ url('invoiceppn') }}" class="warning" style="font-size: 40px;">
                            <ion-icon name="file-tray-stacked-outline"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        <span class="text-center">Stock</span>
                    </div>
                </div>
                
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="{{ url('invoiceppn') }}" class="warning" style="font-size: 40px;">
                            <ion-icon name="document-text"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        <span class="text-center">Histori</span>
                    </div>
                </div> --}}
                
                @elseif(auth()->user()->level=="marketing")
                <div class="list-menu">
                    <div class="item-menu text-center">
                        <div class="menu-icon">                           
                            <a href="{{ url('/penawaran') }}" class="purple">
                                <ion-icon name="trending-down-outline" size="large"></ion-icon>
                        </div>
                        <div class="menu-name">
                            <span class="text-center" >Penawaran</span>
                        </div></a>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                                <a href="{{ url('/laporan-barang') }}" class="purple" >
                                    <ion-icon name="cash-outline" size="large"></ion-icon>
                                
                            </div>
                            <div class="menu-name">
                                <span class="text-center">Laporan</span><br>
                                <span class="text-center">Barang</span>
                            </div></a>
                        </div>
                        <div class="item-menu text-center">
                            <div class="menu-icon">                           
                                <a href="{{ url('/sponsor-request/create') }}" class="purple" style="font-size: 40px;">
                                    <ion-icon name="archive-outline"></ion-icon>
                                </a>
                            </div>
                            <div class="menu-name">
                                <span class="text-center" >Sponsor</span>
                            </div>
                        </div>
                        
                @endif
                @endif
                
            </div>
        </div>

        <div class="card-body text-center">
            @if(Auth::check())
            @if(auth()->user()->level=="superadmin")
            <div class="list-menu">
                <div class="list-menu">
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="{{ url('pengiriman') }}" class="purple">
                                <i class="mdi mdi-truck-delivery" style="font-size: 32px;"></i>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Pengiriman</span>
                        </div></a>
                    </div>
                </div>
                <div class="list-menu">
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="{{ url('customer') }}" class="purple">
                                <i class="mdi mdi-account-convert" style="font-size: 32px;"></i>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Customer</span>
                        </div></a>
                    </div>
                @endif
                @endif
                
            </div>
        </div>
    </div>
</div>




    
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

@endsection
