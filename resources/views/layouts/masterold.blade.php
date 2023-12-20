<!DOCTYPE html>
<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>
            Laksa Medika
        </title>
        <link rel="icon" type="image/x-icon" href="{{ URL::asset('assets/images/icon.png')}}">
        
         <style>
            .jumbotron {
              padding: 2rem 1rem;
              margin-bottom: 2rem;
              border-radius: 0.3rem;
            
              background: #1a2a6c;  /* fallback for old browsers */
              background: -webkit-linear-gradient(to right, #fdbb2d, #b21f1f, #1a2a6c);  /* Chrome 10-25, Safari 5.1-6 */
              background: linear-gradient(to right, #fdbb2d, #b21f1f, #1a2a6c); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            
            }
            .hd1{
                color:#fff;
            }
            </style>
    </head>
    
<meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="stylesheet" href="{{ URL::asset('assets/css/morris.css')}}">
    <link href="{{ URL::asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('assets/css/metismenu.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('assets/css/icons.css" rel="stylesheet')}}" type="text/css">
    <link href="{{ URL::asset('assets/css/style.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@6.6.96/css/materialdesignicons.min.css">
    <!-- jQuery  -->
    <script src="{{ URL::asset('assets/js/jquery.min.js')}}"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.material.min.css"/>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ URL::asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/metismenu.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/jquery.slimscroll.js')}}"></script>
    <script src="{{ URL::asset('assets/js/waves.min.js')}}"></script>
    <!--Morris Chart-->
    <script src="{{ URL::asset('assets/js/morris.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/raphael.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/dashboard.init.js')}}"></script>
    <!-- App js -->
    <script src="{{ URL::asset('assets/js/app.js')}}"></script>
<body>

<!-- Begin page -->
    <div id="wrapper">

        <!-- Top Bar Start -->
        <div class="topbar">

            <!-- LOGO -->
            <div class="topbar-left">
                <a href="#" class="logo">
                    <span class="logo-light">
                            <i class="mdi mdi-camera-control"></i> LAKSA MEDIKA
                        </span>
                    <span class="logo-sm">
                            <i class="mdi mdi-camera-control"></i>
                        </span>
                </a>
            </div>

            <nav class="navbar-custom">
                <ul class="navbar-right list-inline float-right mb-0">

                    <!-- language-->
                    <!--<li class="dropdown notification-list list-inline-item d-none d-md-inline-block">-->
                    <!--    <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">-->
                    <!--        <img src="{{ URL::asset('assets/images/us_flag.jpg')}}" class="mr-2" height="12" alt="" /> English <span class="mdi mdi-chevron-down"></span>-->
                    <!--    </a>-->
                    <!--    <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated language-switch">-->
                    <!--        <a class="dropdown-item" href="#"><img src="{{ URL::asset('assets/images/french_flag.jpg')}}" alt="" height="16" /><span> French </span></a>-->
                    <!--        <a class="dropdown-item" href="#"><img src="{{ URL::asset('assets/images/spain_flag.jpg')}}" alt="" height="16" /><span> Spanish </span></a>-->
                    <!--        <a class="dropdown-item" href="#"><img src="{{ URL::asset('assets/images/russia_flag.jpg')}}" alt="" height="16" /><span> Russian </span></a>-->
                    <!--        <a class="dropdown-item" href="#"><img src="{{ URL::asset('assets/images/germany_flag.jpg')}}" alt="" height="16" /><span> German </span></a>-->
                    <!--        <a class="dropdown-item" href="#"><img src="{{ URL::asset('assets/images/italy_flag.jpg')}}" alt="" height="16" /><span> Italian </span></a>-->
                    <!--    </div>-->
                    <!--</li>-->

                    <!-- full screen -->
                    <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
                        <a class="nav-link waves-effect" href="#" id="btn-fullscreen">
                            <i class="mdi mdi-arrow-expand-all noti-icon"></i>
                        </a>
                    </li>

                    <!-- notification -->
                    <li class="dropdown notification-list list-inline-item" id="notif">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="mdi mdi-bell-outline noti-icon"></i>
                            <span id="total-alert" class="badge badge-pill badge-danger noti-icon-badge">{{ $alert->count()+$productalert+$alertppn->count()}}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-menu-lg px-1">
                            <ul class="nav nav-tabs">
                                <li class="nav-item list-product">
                                    <a class="nav-link" aria-current="page" href="#">Product
                                        <span id="product-alert" class=" badge badge-pill badge-danger">{{$productalert}}</span>
                                    </a>

                                </li>
                                <li class="nav-item list-invoices">
                                    <a class="nav-link" href="#">Inv
                                        <span id="invoices-alert" class="badge badge-pill badge-danger">{{$alert->count()}}</span>
                                    </a>
                                </li>
                                <li class="nav-item list-invoicesppn">
                                    <a class="nav-link" href="#">Inv PPN
                                        <span id="invoicesppn-alert" class="badge badge-pill badge-danger">{{$alertppn->count()}}</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="order-notification" style="overflow: auto; max-height:400px;">
                            <!-- All-->
                            <a href="javascript:void(0);" class="dropdown-item text-center notify-all text-primary">
                                    View all <i class="fi-arrow-right"></i>
                                </a>
                        </div>
                    </li>

                    <li class="dropdown notification-list list-inline-item">
                        <div class="dropdown notification-list nav-pro-img">
                            <a class="dropdown-toggle nav-link arrow-none nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                @if(empty(Auth::user()->foto))
                                <img class="img-account-profile rounded-circle mb-2" src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="" height="100px">
                                @else
                                <img class="img-account-profile rounded-circle mb-2" src="{{ URL::asset('images/'.Auth::user()->foto) }}" alt="" height="100px">
                                @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                <!-- item-->
                                <a class="dropdown-item" href="{{ url('/user') }}"><i class="mdi mdi-account-circle"></i> Profile</a>
                                <!--<a class="dropdown-item" href="#"><i class="mdi mdi-wallet"></i> Wallet</a>-->
                                <!--<a class="dropdown-item d-block" href="#"><span class="badge badge-success float-right">11</span><i class="mdi mdi-settings"></i> Settings</a>-->
                                @guest
                                @if (Route::has('login'))
                                <a class="dropdown-item" href="{{ route('login') }}"><i class="mdi mdi-login"></i>
                                {{ __('Login') }}
                                @endif                                 
                                </a>
                                @if (Route::has('register'))
                                <a class="dropdown-item" href="{{ route('register') }}"><i class="mdi mdi-account-plus"></i>
                                {{ __('Register') }}
                                @endif                                 
                                </a>
                                @else
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                 onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                              <i class="mdi mdi-power text-danger"></i>
                                 {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                 @csrf
                                 </form>
                                 @endguest  
                            </div>
                        </div>
                    </li>

                </ul>

                <ul class="list-inline menu-left mb-0">
                    <li class="float-left">
                        <button class="button-menu-mobile open-left waves-effect">
                            <i class="mdi mdi-menu"></i>
                        </button>
                    </li>
                    <li class="d-none d-md-inline-block">
                        <form role="search" class="app-search">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control" placeholder="Search..">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </li>
                </ul>

            </nav>

        </div>
        <!-- Top Bar End -->

        <!-- ========== Left Sidebar Start ========== -->
        <div class="left side-menu">
            <div class="slimscroll-menu" id="remove-scroll">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu" id="side-menu">
                        <li class="menu-title">Menu</li>
                        <li>
                            <a href="{{ route('home') }}" class="waves-effect">
                                <i class="mdi mdi-monitor-dashboard"></i><span class="badge badge-success badge-pill float-right"></span> <span> Dashboard </span>
                            </a>
                        </li>


                        @if(Auth::check())
                        @if(auth()->user()->level=="superadmin")
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-cart"></i><span> Transactions <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                                <li><a href="{{ url('product') }}" class="nav-link {{ (request()->is('product')) ? 'active' : '' }}">Product</a></li>
                                <li><a href="{{ url('customer') }}" class="nav-link {{ (request()->is('customer')) ? 'active' : '' }}">Customer</a></li>
                                <li><a href="{{ url('/add/nondanppn') }}" class="nav-link {{ (request()->is('invoice/add/nondanppn')) ? 'active' : '' }}">Add Invoice</a></li>
                                {{-- <li><a href="{{ url('invoice/new') }}" class="nav-link {{ (request()->is('invoice/new')) ? 'active' : '' }}">Invoice</a></li> --}}

                                <li>
                                    <a href="javascript:void(0);" class="waves-effect"><span>My Invoice <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                                    <ul class="submenu">
                                        <li><a href="{{ url('invoice') }}">NON PPN</a></li>
                                        <li><a href="{{ url('invoiceppn') }}">PPN</a></li>                                
                                    </ul>
                                </li>                                 
                            </ul>
                        </li>
                        @elseif(auth()->user()->level=="admin")
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-cart"></i><span> Transactions <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                                <li><a href="{{ url('product') }}" class="nav-link {{ (request()->is('product')) ? 'active' : '' }}">Product</a></li>
                                <li><a href="{{ url('customer') }}" class="nav-link {{ (request()->is('customer')) ? 'active' : '' }}">Customer</a></li>
                                <li><a href="{{ url('/add/nondanppn') }}" class="nav-link {{ (request()->is('invoice/add/nondanppn')) ? 'active' : '' }}">Add Invoice</a></li>
                                {{-- <li><a href="{{ url('invoice/new') }}" class="nav-link {{ (request()->is('invoice/new')) ? 'active' : '' }}">Invoice</a></li> --}}

                                <li>
                                    <a href="javascript:void(0);" class="waves-effect"><span>My Invoice <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                                    <ul class="submenu">
                                        <li><a href="{{ url('invoice') }}">NON PPN</a></li>
                                        <li><a href="{{ url('invoiceppn') }}">PPN</a></li>                                
                                    </ul>
                                </li>                                 
                            </ul>
                        </li>
                        @elseif(auth()->user()->level=="marketing")
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-cart"></i><span> Transactions <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                                <li><a href="{{ url('/add/nondanppn') }}" class="nav-link {{ (request()->is('invoice/add/nondanppn')) ? 'active' : '' }}">Add Invoice</a></li>
                                {{-- <li><a href="{{ url('invoice/new') }}" class="nav-link {{ (request()->is('invoice/new')) ? 'active' : '' }}">Invoice</a></li> --}}

                                <li>
                                    <a href="javascript:void(0);" class="waves-effect"><span>My Invoice <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                                    <ul class="submenu">
                                        <li><a href="{{ url('invoice') }}">NON PPN</a></li>
                                        <li><a href="{{ url('invoiceppn') }}">PPN</a></li>                                
                                    </ul>
                                </li>                                 
                            </ul>
                        </li>
                        @endif
                        @endif

                        @if(Auth::check())
                        @if(auth()->user()->level=="superadmin")
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-briefcase"></i> <span> Invoice <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                            <ul class="submenu">
                                <li><a href="{{ route('invoice.allinvoice') }}">NON PPN</a></li>
                                <li><a href="{{ route('invoiceppn.allinvoice') }}">PPN</a></li>                                
                            </ul>
                        </li>
                        @elseif(auth()->user()->level=="admin")
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-briefcase"></i> <span> Invoice <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                            <ul class="submenu">
                                <li><a href="{{ route('invoice.allinvoice') }}">NON PPN</a></li>
                                <li><a href="{{ route('invoiceppn.allinvoice') }}">PPN</a></li>                                
                            </ul>
                        </li>
                        @elseif(auth()->user()->level=="marketing")
                        @endif  
                        @endif                    

                        @if(Auth::check())
                        @if(auth()->user()->level=="superadmin")
                        <li class="menu-title">Laporan</li>
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-chart-box"></i> <span> Laporan <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                            <ul class="submenu">
                                <li><a href="{{ url('/laporan-penjualan')}}">Penjualan</a></li>
                                <li><a href="{{ url('/laporan-barang')}}">Barang</a></li>
                                <li>
                                    <a href="javascript:void(0);" class="waves-effect"><span>Faktur Lunas <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                                    <ul class="submenu">
                                        <li><a href="{{ route('invoice.trash') }}">NON PPN</a></li>
                                        <li><a href="{{ route('invoiceppn.trash') }}">PPN</a></li>                                
                                    </ul>
                                </li>   
                                
                            </ul>
                        </li>
                        @elseif(auth()->user()->level=="admin")
                        <li class="menu-title">Laporan</li>
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-chart-box"></i> <span> Laporan <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                            <ul class="submenu">
                                <li><a href="{{ url('/laporan-penjualan')}}">Penjualan</a></li>
                                <li><a href="{{ url('/laporan-barang')}}">Barang</a></li>
                                <li>
                                    <a href="javascript:void(0);" class="waves-effect"><span>Faktur Lunas <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                                    <ul class="submenu">
                                        <li><a href="{{ route('invoice.trash') }}">NON PPN</a></li>
                                        <li><a href="{{ route('invoiceppn.trash') }}">PPN</a></li>                                
                                    </ul>
                                </li>   
                                
                            </ul>
                        </li>
                        @elseif(auth()->user()->level=="marketing")
                        <li class="menu-title">Laporan</li>
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-chart-box"></i> <span> Laporan <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                            <ul class="submenu">
                                <li><a href="{{ url('/laporan-barang')}}">Barang</a></li> 
                                
                            </ul>
                        </li>
                        @elseif(auth()->user()->level=="marketingcustomer")
                        <li class="menu-title">Laporan</li>
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-chart-box"></i> <span> Laporan <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                            <ul class="submenu">
                                <li><a href="{{ url('/laporan-barang')}}">Barang</a></li> 
                                
                            </ul>
                        </li>
                        @endif
                        @endif

                        
                        @if(Auth::check())
                        @if(auth()->user()->level=="superadmin")
                        <li class="menu-title">Karyawan</li>
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-clipboard-list-outline"></i> <span> Penawaran <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                            <ul class="submenu">
                                <li><a href="{{url('penawaran')}}">Penawaran</a></li>
                                <li><a href="{{url('/penawaran/all/')}}">Semua Penawaran</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-file-chart"></i> <span> Daily Report <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                            <ul class="submenu">
                                    <li><a href="{{ url('daily-report-marketing') }}">My Daily Report</a></li>
                                    <li><a href="{{ url('daily-report-marketing/all') }}">Daily Report</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-clipboard-list-outline"></i> <span> Knowledge <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                            <ul class="submenu">
                                <li><a href="{{url('soal')}}">Test Knowledge</a></li>
                                <li><a href="{{url('soal/hasiltest')}}">Hasil Test Knowledge</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-car-cog"></i> <span> Service Kendaraan <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                            <ul class="submenu">
                                <li><a href="{{url('service-kendaraan')}}">Pengajuan Service Kendaraan</a></li>
                            </ul>
                        </li>
                        @elseif(auth()->user()->level=="admin")
                        <li class="menu-title">Karyawan</li>
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-clipboard-list-outline"></i> <span> Penawaran <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                            <ul class="submenu">
                                <li><a href="{{url('penawaran')}}">Penawaran</a></li>
                                <li><a href="{{url('/penawaran/all/')}}">Semua Penawaran</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-file-chart"></i> <span> Daily Report <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                            <ul class="submenu">
                                    <li><a href="{{ url('daily-report-marketing') }}">My Daily Report</a></li>
                                    <li><a href="{{ url('daily-report-marketing/all') }}">Daily Report</a></li>
                            </ul>
                        </li>
                        
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-clipboard-list-outline"></i> <span> Knowledge <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                            <ul class="submenu">
                                <li><a href="{{url('soal')}}">Test Knowledge</a></li>
                                <li><a href="{{url('soal/hasiltest')}}">Hasil Test Knowledge</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-car-cog"></i> <span> Service Kendaraan <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                            <ul class="submenu">
                                <li><a href="{{url('service-kendaraan')}}">Pengajuan Service Kendaraan</a></li>
                            </ul>
                        </li>
                        @elseif(auth()->user()->level=="marketing")
                        <li class="menu-title">Karyawan</li>
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-clipboard-list-outline"></i> <span> Penawaran <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                            <ul class="submenu">
                                <li><a href="{{url('penawaran')}}">Penawaran</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-file-chart"></i> <span> Daily Report <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                            <ul class="submenu">
                                    <li><a href="{{ url('daily-report-marketing') }}">My Daily Report</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-clipboard-list-outline"></i> <span> Knowledge <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                            <ul class="submenu">
                                <li><a href="{{url('soal')}}">Test Knowledge</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-car-cog"></i> <span> Service Kendaraan <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                            <ul class="submenu">
                                <li><a href="{{url('service-kendaraan')}}">Pengajuan Service Kendaraan</a></li>
                            </ul>
                        </li>
                        @elseif(auth()->user()->level=="marketingcustomer")
                        <li class="menu-title">Karyawan</li>
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-clipboard-list-outline"></i> <span> Penawaran <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                            <ul class="submenu">
                                <li><a href="{{url('penawaran')}}">Penawaran</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-file-chart"></i> <span> Daily Report <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                            <ul class="submenu">
                                    <li><a href="{{ url('daily-report-marketing') }}">My Daily Report</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-clipboard-list-outline"></i> <span> Knowledge <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                            <ul class="submenu">
                                <li><a href="{{url('soal')}}">Test Knowledge</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-car-cog"></i> <span> Service Kendaraan <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                            <ul class="submenu">
                                <li><a href="{{url('service-kendaraan')}}">Pengajuan Service Kendaraan</a></li>
                            </ul>
                        </li>
                        @endif
                        @endif

                        @if(Auth::check())
                        @if(auth()->user()->level=="superadmin")
                        <li class="menu-title">Informasi Alat</li>
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-information"></i> <span> Hemoglobin <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                            <ul class="submenu">
                                <li><a href="{{url('hemoglobin-yofalab')}}">Hemoglobin Yofalab</a></li>
                                <li><a href="{{url('hemochroma')}}">Hemochroma</a></li>
                                
                            </ul>
                        </li>
                        @elseif(auth()->user()->level=="admin")
                        <li class="menu-title">Informasi Alat</li>
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-information"></i> <span> Hemoglobin <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                            <ul class="submenu">
                                <li><a href="{{url('hemoglobin-yofalab')}}">Hemoglobin Yofalab</a></li>
                                <li><a href="{{url('hemochroma')}}">Hemochroma</a></li>
                                
                            </ul>
                        </li>
                        @elseif(auth()->user()->level=="marketing")
                        @endif
                        @endif

                        @if(Auth::check())
                        @if(auth()->user()->level=="superadmin")
                        <li class="menu-title">Customer</li>
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-cart"></i> <span> Order Customer <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                            <ul class="submenu">
                                <li><a href="{{url('customer-order')}}">My Orders</a></li>
                                <li><a href="{{route('invoicecustomer.allinvoice')}}">Customer Orders</a></li>
                                
                            </ul>
                        </li>
                        @elseif(auth()->user()->level=="admin")
                        <li class="menu-title">Customer</li>
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-cart"></i> <span> Order Customer <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                            <ul class="submenu">
                                <li><a href="{{route('invoicecustomer.allinvoice')}}">Customer Orders</a></li>
                                
                            </ul>
                        </li>
                        @elseif(auth()->user()->level=="customer")
                        <li class="menu-title">Customer</li>
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-cart"></i> <span> Order Customer <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                            <ul class="submenu">
                                <li><a href="{{url('customer-order')}}">My Orders</a></li>                                
                            </ul>
                        </li>
                        @elseif(auth()->user()->level=="marketing")
                        @endif
                        @endif
                        {{-- <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="icon-diamond"></i> <span> Advanced UI <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                            <ul class="submenu">
                                <li><a href="#">Alertify</a></li>
                                <li><a href="#">Rating</a></li>
                               
                            </ul>
                        </li>

                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="icon-todolist-check"></i><span> Forms <span class="badge badge-pill badge-danger float-right">8</span> </span></a>
                            <ul class="submenu">
                                <li><a href="#">Form Elements</a></li>
                                <li><a href="#">Form Validation</a></li>
                             
                            </ul>
                        </li>

                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="icon-graph"></i><span> Charts <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                                <li><a href="#">Morris Chart</a></li>
                                <li><a href="#">Chartist Chart</a></li>
                                <li><a href="#">Chartjs Chart</a></li>
                                <li><a href="#">Flot Chart</a></li>
                                <li><a href="#">C3 Chart</a></li>
                                <li><a href="#">Jquery Knob Chart</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="icon-spread"></i><span> Tables <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                                <li><a href="#">Basic Tables</a></li>
                                <li><a href="#">Data Table</a></li>
                                
                            </ul>
                        </li>

                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="icon-coffee"></i> <span> Icons  <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span> </a>
                            <ul class="submenu">
                                <li><a href="#">Material Design</a></li>
                                <li><a href="#">Font Awesome</a></li>
                                
                            </ul>
                        </li>

                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="icon-map"></i><span> Maps <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                                <li><a href="#"> Google Map</a></li>
                                <li><a href="#"> Vector Map</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="icon-share"></i><span> Multi Level <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                                <li><a href="#"> Menu 1</a></li>
                                <li>
                                    <a href="#">Menu 2  <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                                    <ul class="submenu">
                                        <li><a href="#">Menu 2.1</a></li>
                                        <li><a href="#">Menu 2.1</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li> --}}

                    </ul>

                </div>
                <!-- Sidebar -->
                <div class="clearfix"></div>

            </div>
            <!-- Sidebar -left -->

        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
            <section class="content">
                @yield('content')
            </section>
                <!-- container-fluid -->

            </div>
            <!-- content -->

            <footer class="footer">
                ©2010 -2023 Laksa Medika Internusa <span class="d-none d-sm-inline-block"> <i class="mdi mdi-heart text-danger"></i> Laksamedical.com</span>.
            </footer>

        </div>
        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->
</body>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.list-invoices').on('click ', function() {
            $.ajax({
                url: "{{ route('notif') }}",
                type: 'get',
                dataType: 'html',
                success: function(data) {
                    console.log(data)
                    $('.order-notification').html(data);
                }
            })
        });
        $('.list-invoicesppn').on('click ', function() {
            $.ajax({
                url: "{{ route('notif.ppn') }}",
                type: 'get',
                dataType: 'html',
                success: function(data) {
                    console.log(data)
                    $('.order-notification').html(data);
                }
            })
        });
        $('.list-product').on('click ', function() {
            $.ajax({
                url: "{{ route('notif.product') }}",
                type: 'get',
                dataType: 'html',
                success: function(data) {
                    console.log(data)
                    $('.order-notification').html(data);
                }
            })
        });
    
        $('#notif').click(function() {
            $('#notif').toggleClass('show')
        })
        $('.nav-item').click(function(e) {
            e.stopPropagation();
            $('.nav-link').removeClass('active')
            $(this).children('.nav-link').addClass('active')
            
        })
    
    });
    </script>
    <script>
        $(document).ready(function () {
    $('#data_users_reguler').DataTable();
});
    </script>
</html>