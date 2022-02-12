@extends('layouts.admin')

@section('title', 'PerpustakaanXYZ | Tambah Kategori')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    {{-- breadcrumb --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Kategori</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Kategori</li>
        </ol>
    </nav>

    {{-- content --}}
    <div class="card shadow-sm">
        <div class="container py-4">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Tambah Kategori</h1>

            <div class="col-md-8">

                {{-- form --}}
                <form action="{{ route('category.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama Kategori</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" placeholder="Ex: Psikologi" value="{{ old('name') }}" autofocus>
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="location">Lokasi Penyimpanan</label>
                        <input type="text" class="form-control @error('location') is-invalid @enderror" id="location"
                            name="location" placeholder="Ex: Rak Buku 1" value="{{ old('location') }}">
                        @error('location')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="floor">Lantai Perpustakaan</label>
                        <select class="form-control @error('floor') is-invalid @enderror" id="floor" name="floor">
                            <option value="1" {{ old('floor') == '1' ? 'selected' : '' }}>1</option>
                            <option value="2" {{ old('floor') == '2' ? 'selected' : '' }}>2</option>
                            <option value="3" {{ old('floor') == '3' ? 'selected' : '' }}>3</option>
                        </select>
                        @error('floor')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary d-block w-100 text-center">Simpan</button>
                </form>

            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection
