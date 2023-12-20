   
   <!-- App Bottom Menu -->
   <div class="appBottomMenu">
    @if(Auth::check())
    @if(auth()->user()->level=="superadmin") 
    <a href="{{ url('home') }}" class="item">
        <div class="col">
            <ion-icon name="home-outline" role="img" class="md hydrated"
                aria-label="file tray full outline"></ion-icon>
            <strong>Beranda</strong>
        </div>
    </a>
    <a href="{{ url('invoice') }}" class="item active">
        <div class="col">
            <ion-icon name="calendar-outline" role="img" class="md hydrated"
                aria-label="calendar outline"></ion-icon>
            <strong>Riwayat</strong>
        </div>
    </a>

    <div class="item">
        <div class="col"> 
            <form action="{{ route('invoicecustomer.store') }}" method="post">
                @csrf
                <input type="hidden" value="0" name="total" class="form-control" >
                <a class="purple" style="font-size: 40px;">   
            </a>
        </div>
        <div class="action-button large bg-dark">
            <button class=" purple " style="
            margin-bottom: 25px;
            padding-right: 25px;
            padding-left: 0px;
            border-top-width: 0px;
            border-left-width: 0px;
            border-right-width: 0px;
            border-bottom-width: 0px;
            height: 0px;
            width: 0px;
            padding-top: 0px;
            padding-bottom: 0px;" 
         ><ion-icon name="cart-outline" role="img" class="md hydrated" aria-label="add outline"></ion-icon></button>
        </div></form>    
    </div>
    
    {{-- <a href="{{ url('/add/nondanppn') }}" class="item">
        <div class="col">
            <div class="action-button large">
                <ion-icon name="cart-outline" role="img" class="md hydrated" aria-label="add outline"></ion-icon>
            </div>
        </div>
    </a> --}}
    <a href="{{ url('daily-report-marketing') }}" class="item">
        <div class="col">
            <ion-icon name="document-text-outline" role="img" class="md hydrated"
                aria-label="document text outline"></ion-icon>
            <strong>Report</strong>
        </div>
    </a>
    <a href="{{ url('/user') }}" class="item">
        <div class="col">
            <ion-icon name="people-outline" role="img" class="md hydrated" aria-label="people outline"></ion-icon>
            <strong>Profile</strong>
        </div>
    </a>
    @elseif(auth()->user()->level=="marketing")
    <a href="{{ url('home') }}" class="item">
        <div class="col">
            <ion-icon name="home-outline" role="img" class="md hydrated"
                aria-label="file tray full outline"></ion-icon>
            <strong>Beranda</strong>
        </div>
    </a>
    <a href="{{ url('invoice') }}" class="item active">
        <div class="col">
            <ion-icon name="calendar-outline" role="img" class="md hydrated"
                aria-label="calendar outline"></ion-icon>
            <strong>Riwayat</strong>
        </div>
    </a>

    <div class="item">
        <div class="col"> 
            <form action="{{ route('invoicecustomer.store') }}" method="post">
                @csrf
                <input type="hidden" value="0" name="total" class="form-control" >
                <a class="purple" style="font-size: 40px;">   
            </a>
        </div>
        <div class="action-button large bg-dark">
            <button class=" purple " style="
            margin-bottom: 25px;
            padding-right: 25px;
            padding-left: 0px;
            border-top-width: 0px;
            border-left-width: 0px;
            border-right-width: 0px;
            border-bottom-width: 0px;
            height: 0px;
            width: 0px;
            padding-top: 0px;
            padding-bottom: 0px;" 
         ><ion-icon name="cart-outline" role="img" class="md hydrated" aria-label="add outline"></ion-icon></button>
        </div></form>    
    </div>
    
    {{-- <a href="{{ url('/add/nondanppn') }}" class="item">
        <div class="col">
            <div class="action-button large">
                <ion-icon name="cart-outline" role="img" class="md hydrated" aria-label="add outline"></ion-icon>
            </div>
        </div>
    </a> --}}
    <a href="{{ url('daily-report-marketing') }}" class="item">
        <div class="col">
            <ion-icon name="document-text-outline" role="img" class="md hydrated"
                aria-label="document text outline"></ion-icon>
            <strong>Report</strong>
        </div>
    </a>
    <a href="{{ url('/user') }}" class="item">
        <div class="col">
            <ion-icon name="people-outline" role="img" class="md hydrated" aria-label="people outline"></ion-icon>
            <strong>Profile</strong>
        </div>
    </a>

    @elseif(auth()->user()->level=="customer")
    <a href="{{ url('home') }}" class="item">
        <div class="col">
            <ion-icon name="home-outline" role="img" class="md hydrated"
                aria-label="file tray full outline"></ion-icon>
            <strong>Beranda</strong>
        </div>
    </a>
    <a href="{{ url('customer-order') }}" class="item active">
        <div class="col">
            <ion-icon name="calendar-outline" role="img" class="md hydrated"
                aria-label="calendar outline"></ion-icon>
            <strong>Riwayat</strong>
        </div>
    </a>

    <div class="item">
        <div class="col"> 
            <form action="{{ route('invoicecustomer.store') }}" method="post">
                @csrf
                <input type="hidden" value="0" name="total" class="form-control" >
                <a class="purple" style="font-size: 40px;">   
            </a>
        </div>
        <div class="action-button large bg-dark">
            <button class=" purple " style="
            margin-bottom: 25px;
            padding-right: 25px;
            padding-left: 0px;
            border-top-width: 0px;
            border-left-width: 0px;
            border-right-width: 0px;
            border-bottom-width: 0px;
            height: 0px;
            width: 0px;
            padding-top: 0px;
            padding-bottom: 0px;" 
         ><ion-icon name="cart-outline" role="img" class="md hydrated" aria-label="add outline"></ion-icon></button>
        </div></form>    
    </div>
    
    {{-- <a href="{{ url('/add/nondanppn') }}" class="item">
        <div class="col">
            <div class="action-button large">
                <ion-icon name="cart-outline" role="img" class="md hydrated" aria-label="add outline"></ion-icon>
            </div>
        </div>
    </a> --}}
    <a href="{{ url('/brosur-user') }}" class="item">
        <div class="col">
            <ion-icon name="document-text-outline" role="img" class="md hydrated"
                aria-label="document text outline"></ion-icon>
            <strong>Brosur</strong>
        </div>
    </a>
    <a href="{{ url('/user') }}" class="item">
        <div class="col">
            <ion-icon name="people-outline" role="img" class="md hydrated" aria-label="people outline"></ion-icon>
            <strong>Profile</strong>
        </div>
    </a>
    @elseif(auth()->user()->level=="marketing")
    <a href="{{ url('home') }}" class="item">
        <div class="col">
            <ion-icon name="home-outline" role="img" class="md hydrated"
                aria-label="file tray full outline"></ion-icon>
            <strong>Beranda</strong>
        </div>
    </a>
    <a href="{{ url('invoice') }}" class="item active">
        <div class="col">
            <ion-icon name="calendar-outline" role="img" class="md hydrated"
                aria-label="calendar outline"></ion-icon>
            <strong>Riwayat</strong>
        </div>
    </a>

    <div class="item">
        <div class="col"> 
            <form action="{{ route('invoicecustomer.store') }}" method="post">
                @csrf
                <input type="hidden" value="0" name="total" class="form-control" >
                <a class="purple" style="font-size: 40px;">   
            </a>
        </div>
        <div class="action-button large bg-dark">
            <button class=" purple " style="
            margin-bottom: 25px;
            padding-right: 25px;
            padding-left: 0px;
            border-top-width: 0px;
            border-left-width: 0px;
            border-right-width: 0px;
            border-bottom-width: 0px;
            height: 0px;
            width: 0px;
            padding-top: 0px;
            padding-bottom: 0px;" 
         ><ion-icon name="cart-outline" role="img" class="md hydrated" aria-label="add outline"></ion-icon></button>
        </div></form>    
    </div>
    
    {{-- <a href="{{ url('/add/nondanppn') }}" class="item">
        <div class="col">
            <div class="action-button large">
                <ion-icon name="cart-outline" role="img" class="md hydrated" aria-label="add outline"></ion-icon>
            </div>
        </div>
    </a> --}}
    <a href="{{ url('daily-report-marketing') }}" class="item">
        <div class="col">
            <ion-icon name="document-text-outline" role="img" class="md hydrated"
                aria-label="document text outline"></ion-icon>
            <strong>Rreport</strong>
        </div>
    </a>
    <a href="{{ url('/user') }}" class="item">
        <div class="col">
            <ion-icon name="people-outline" role="img" class="md hydrated" aria-label="people outline"></ion-icon>
            <strong>Profile</strong>
        </div>
    </a>


    @elseif(auth()->user()->level=="gudang")
    <a href="{{ url('home') }}" class="item">
        <div class="col">
            <ion-icon name="home-outline" role="img" class="md hydrated"
                aria-label="file tray full outline"></ion-icon>
            <strong>Beranda</strong>
        </div>
    </a>
    <a href="{{ url('/user') }}" class="item">
        <div class="col">
            <ion-icon name="people-outline" role="img" class="md hydrated" aria-label="people outline"></ion-icon>
            <strong>Profile</strong>
        </div>
    </a>
    @endif
    @endif
</div>
<!-- * App Bottom Menu -->