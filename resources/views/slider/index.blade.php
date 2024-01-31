@extends('layouts.master')
@section('content')
    @include('layouts.topNavBack')
    <div class="container">
        <div class="card">
            <div class="carousel-container">
                <div class="carousel">
                    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($sliders as $slider)
                                <div class="carousel-item @if($loop->first) active @endif">
                                    <div class="slider-image text-center">
                                        <img src="{{ asset('images/slider/' . $slider->image) }}" alt="Slider Image" style="max-width: autopx;">
                                    </div>
                                </div>
                            @endforeach
                        </div>
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
        <div class="card">
            <a href="{{ route('slider.create') }}" class="btn btn-lg btn-primary"><i class="mdi mdi-account-plus">Tambah Slider</i></a>
        </div>
    </div>
    <script>

    </script>
@endsection
