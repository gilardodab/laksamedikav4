<!-- resources/views/slider/create.blade.php -->
@extends('layouts.master')
@section('content')
@include('layouts.topNavBack')
    <h1>Tambah Slider Baru</h1>

    <form action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image Size 1920x600</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection
