<!-- resources/views/slider/index.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Daftar Slider</h1>
    <a href="{{ route('slider.create') }}" class="btn btn-success">Tambah Slider</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sliders as $slider)
                <tr>
                    <td>{{ $slider->id }}</td>
                    <td>{{ $slider->title }}</td>
                    <td>{{ $slider->description }}</td>
                    <td>
                        <img src="{{ asset('images/slider/' . $slider->image) }}" alt="Slider Image"  >
                    </td>
                    <td>
                        <a href="{{ route('slider.edit', $slider->id) }}" class="btn btn-primary">Edit</a>
                        <!-- Tambahkan tombol Hapus dengan form jika diperlukan -->
                        <form action="{{ route('slider.destroy', $slider->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus slider ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
