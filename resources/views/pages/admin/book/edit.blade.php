@extends('layouts.admin')

@section('title', 'PerpustakaanXYZ | Ubah Buku')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    {{-- breadcrumb --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('book.index') }}">Buku</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ubah Buku</li>
        </ol>
    </nav>

    {{-- content --}}
    <div class="card shadow-sm">
        <div class="container py-4">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800 text-center font-weight-bold">Ubah Buku</h1>

            <div class="row justify-content-center mb-4">
                <div class="col-md-10">

                    {{-- form --}}
                    <form action="{{ route('book.update', $book->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="title">Judul</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                                name="title" placeholder="Ex: Laskar Pelangi"
                                value="{{ old('title') ? old('title') : $book->title }}" autofocus>
                            @error('title')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="writer">Penulis</label>
                            <input type="text" class="form-control @error('writer') is-invalid @enderror" id="writer"
                                name="writer" placeholder="Ex: Andrea Hirata"
                                value="{{ old('writer') ? old('writer') : $book->writer }}">
                            @error('writer')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="publisher">Penerbit</label>
                            <input type="text" class="form-control @error('publisher') is-invalid @enderror"
                                id="publisher" name="publisher" placeholder="Ex: Bentang Pustaka"
                                value="{{ old('publisher') ? old('publisher') : $book->publisher }}">
                            @error('publisher')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="year">Tahun Publikasi</label>
                            <input type="number" class="form-control @error('year') is-invalid @enderror" id="year"
                                name="year" placeholder="Ex: 2005"
                                value="{{ old('year') ? old('year') : $book->year }}">
                            @error('year')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="category_id">Kategori</label>
                            <select class="form-control @error('category_id') is-invalid @enderror" id="category_id"
                                name="category_id">
                                {{-- list kategori --}}
                                @forelse ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ (old('category_id') ?? $book->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                @empty
                                <option>Tidak ada data</option>
                                @endforelse
                            </select>
                            @error('category_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="cover">Sampul</label>
                            <div class="mb-3">
                                <img src="{{ asset('images/covers/' . $book->cover) }}" alt="{{ $book->title }}"
                                    class="img-sm">
                            </div>
                            <input type="hidden" name="coverOld" value="{{ $book->cover }}">
                            <input type="file" class="form-control" id="cover" name="cover">
                            @error('cover')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <input type="hidden" class="@error('description') is-invalid @enderror" id="description"
                                name="description" placeholder="Ex: 10"
                                value="{{ old('description') ? old('description') : $book->description }}">
                            <trix-editor input="description"></trix-editor>
                            @error('description')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="stock">Stok</label>
                            <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock"
                                name="stock" placeholder="Ex: 10"
                                value="{{ old('stock') ? old('stock') : $book->stock }}">
                            @error('stock')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary d-block w-100 text-center">Simpan</button>
                    </form>

                </div>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection

{{-- melampirkan push trix-editor --}}
@include('includes.trix')
