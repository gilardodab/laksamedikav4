<!-- resources/views/invoice/allinvoice.blade.php -->
@extends('layouts.master')
@section('content')
@include('layouts.topNavBack')
<body class="bg-white">

    <!-- App Capsule -->
    <div id="appCapsule">

        <div class="error-page">
            <div class="mb-2">
                <img src="assets/img/sample/photo/vector3.png" alt="alt" class="imaged square w200">
            </div>
            <h1 class="title">Sedang Tahap Pengembangan!</h1>
            <div class="text mb-3">
                Halaman Sedang dalam Perbaikan
            </div>
            <div id="countDown" class="mb-5"></div>
        </div>

    </div>
    <!-- * App Capsule -->


    <!-- ///////////// Js Files ////////////////////  -->

    <!-- ////////////////////////////////////////////////////////// -->
    <!-- only for under construction page -->
    <!-- jQuery Countdown -->
    <script src="assets/js/plugins/jquery-countdown/jquery.countdown.min.js"></script>
    <!-- jQuery Countdown Settings -->

    <!-- ////////////////////////////////////////////////////////// -->

</body>
@endsection