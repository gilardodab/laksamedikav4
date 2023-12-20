 <!-- App Header -->
 <div class="appHeader bg-dark text-light">
    <div class="left">
        <a href="#" class="headerButton" data-toggle="modal" data-target="#sidebarPanel">
            <ion-icon name="menu-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">
        {{-- <img src="{{ URL::asset('assets/images/logo_ptlmi.png')}}" alt="logo" class="logo"> --}}
        <span class="title "> LAKSA MEDIKA </span>
    </div>

                        @if(Auth::check())
                        @if(auth()->user()->level=="superadmin") 
                        <!-- notification -->
                        <li class="dropdown notification-list list-inline-item" id="notif" style="
                        left: 10%;>
                            <a class="nav-link dropdown-toggle arrow-none waves-effect" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="mdi mdi-bell-outline noti-icon"></i>
                                <span id="total-alert" class="badge badge-pill badge-danger noti-icon-badge">{{ $alert->count()+$productalert+$alertppn->count()}}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-menu-lg px-1">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item list-product">
                                        <a class="nav-link" aria-current="page" href="#">Produk
                                            <span id="product-alert" class=" badge badge-pill badge-danger">{{$productalert}}</span>
                                        </a>
    
                                    </li>
                                    <li class="nav-item list-invoices">
                                        <a class="nav-link" href="#">Invoice
                                            <span id="invoices-alert" class="badge badge-pill badge-danger">{{$alert->count()}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item list-invoicesppn">
                                        <a class="nav-link" href="#">Invoice PPN
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
                    @endif
                    @endif
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
    <div class="right">
        <div class="headerButton" data-toggle="dropdown" id="dropdownMenuLink" aria-haspopup="true">
        
           {{-- <img src="'.$base_url.'sw-content/avatar.jpg" alt="image" class="imaged w32"> --}}
           {{-- @if(empty(Auth::user()->foto))
           <img src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="avatar" class="imaged w32 rounded">
           @else
           <img  src="{{ URL::asset('images/'.Auth::user()->foto) }}" alt="avatar" class="imaged w32 rounded">
           @endif --}}
           @if(empty(Auth::user()->foto))
           <img src="{{ URL::asset('asset/img/avatar.png') }}" alt="avatar" class="imaged w32 rounded">
            @else
           <img src="{{ URL::asset('images/'.Auth::user()->foto) }}" alt="avatar" class="imaged w32 rounded">
            @endif

           <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" >
            
            @guest
            @if (Route::has('login'))
            <a class="dropdown-item" href="{{ route('login') }}"><i class="mdi mdi-login"></i>
            {{ __('Login') }}
            @endif                                 
            </a>
            @else
            
            <div class="dropdown-divider"></div>
            <a class="dropdown-item text-danger" href="{{ route('logout') }}"
             onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                          <ion-icon size="small" name="log-out-outline"></ion-icon>
             {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST">
             @csrf
             </form>
             @endguest  


             
        </div>
          </div>
        </div>
    </div>
        <div class="progress" style="display:none;position:absolute;top:50px;z-index:4;left:0px;width: 100%">
            <div id="progressBar" class="progress-bar progress-bar-striped bg-dark" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                <span class="sr-only">0%</span>
            </div>
        </div>
</div>

<!-- App Sidebar -->
<div class="modal fade panelbox panelbox-left" id="sidebarPanel" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body p-1">
                <!-- profile box -->
                <div class="profileBox">
                    <div class="image-wrapper">
                    
                        <h2 id="user-name" >{{ Auth::user()->name }}</h2>
                        <span id="user-role">{{ Auth::user()->level }}</span>
                      
                    </div>
                    <div class="in">
                        <strong></strong>
                        <div class="text-muted"></div>
                    </div>
                    <a href="#" class="btn btn-link btn-icon sidebar-close" data-dismiss="modal">
                        <ion-icon name="close-outline"></ion-icon>
                    </a>
                </div>
                <!-- * profile box -->
          
                <!-- menu -->
                <div class="listview-title mt-1">MENU </div>
                <ul class="listview flush transparent no-line image-listview">
                    @if(Auth::check())
                    @if(auth()->user()->level=="superadmin")        
                    <li>
                        <a href="#" class="item">
                            <div class="icon-box bg-dark">
                                <ion-icon name="home-outline"></ion-icon>
                            </div> Home 
                        </a>
                    </li>
                    <li>
                        <a href="#" class="item">
                            <div class="icon-box bg-dark">
                                <ion-icon name="cube"></ion-icon>
                            </div>
                                Produk
                        </a>
                    </li>

                    <li>
                        <a href="#" class="item">
                            <div class="icon-box bg-dark">
                              <ion-icon name="calendar-outline"></ion-icon>
                            </div>
                              Laporan Harian
                        </a>
                    </li>

                    <li>
                        <a href="#" class="item">
                            <div class="icon-box bg-dark">
                                <ion-icon name="document-text-outline"></ion-icon>
                            </div>
                               History
                        </a>
                    </li>
                  
                    <li>
                        <a href="{{ url('/user') }}" class="item">
                            <div class="icon-box bg-dark">
                                <ion-icon name="person-outline"></ion-icon>
                            </div>
                                Profil
                        </a>
                    </li>

                    </li>
                    <li>
                        <a href="{{ route('logout') }}" method="POST" class="item" >
                            <div class="icon-box bg-dark">
                                <ion-icon name="log-out-outline"></ion-icon>
                            </div>
                                Keluar
                        </a>
                    </li>
                    @elseif(auth()->user()->level=="admin")
                    <li>
                        <a href="#" class="item">
                            <div class="icon-box bg-dark">
                                <ion-icon name="document-text-outline"></ion-icon>
                            </div>
                               Riwayat
                        </a>
                    </li>


                    @elseif(auth()->user()->level=="marketing")
                    <li>
                        <a href="#" class="item">
                            <div class="icon-box bg-dark">
                                <ion-icon name="document-text-outline"></ion-icon>
                            </div>
                               Riwayat
                        </a>
                    </li>

                    @elseif(auth()->user()->level=="customer")
                    <li>
                        <a href="#" class="item">
                            <div class="icon-box bg-dark">
                                <ion-icon name="home-outline"></ion-icon>
                            </div> Home 
                        </a>
                    </li>
                    {{-- <li>
                        <form action="{{ route('invoicecustomer.store') }}" method="post">
                            @csrf
                            <input type="hidden" value="0" name="total" class="form-control" >
                            <a class="purple" style="font-size: 40px;">
                        </a>
                        <button class=" purple " style="
                        margin-top: 0px;
                        padding-right: 0px;
                        padding-left: 20px;
                        border-top-width: 0px;
                        border-left-width: 0px;
                        border-right-width: 0px;
                        border-bottom-width: 0px;
                        height: 0px;
                        width: 0px;
                        padding-top: 0px;
                        padding-bottom: 0px;
                        " 
                     ><ion-icon name="cart-sharp" style="font-size: 20px"></ion-icon></button>
                    </form>
                    </li> --}}
                    <li>
                        <a href="{{ route('invoicecustomer.store') }}" class="item">
                            <div class="icon-box bg-dark">
                                <ion-icon name="document-text-outline"></ion-icon>
                            </div>
                               Riwayat
                        </a>
                    </li>
                    @elseif(auth()->user()->level=="gudang")
                    <li>
                        <a href="#" class="item">
                            <div class="icon-box bg-dark">
                                <ion-icon name="home-outline"></ion-icon>
                            </div> Home 
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/daftar-barang') }}" class="item">
                            <div class="icon-box bg-dark">
                                <ion-icon name="hammer-outline"></ion-icon>
                            </div> Barang 
                        </a>
                    </li>

                    @endif
                    @endif





                    
                </ul>
                <!-- * menu -->
            </div>
        </div>
    </div>
</div>

