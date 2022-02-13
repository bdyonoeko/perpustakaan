@extends('layouts.admin')

@section('title', 'PerpustakaanXYZ | Detail Buku')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    {{-- breadcrumb --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('book.index') }}">Buku</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Buku</li>
        </ol>
    </nav>

    {{-- content --}}
    <div class="card shadow-sm">
        <div class="container py-4">

            {{-- page heading --}}
            <h1 class="h3 font-weight-bold text-gray-800 mb-4 text-center">{{ $book->title }}</h1>

            <div class="row justify-content-center mb-4">
                <div class="col-md-10">

                    {{-- detail --}}
                    <div class="mb-3 text-center">
                        <img src="{{ asset('images/covers/' . $book->cover) }}" alt="{{ $book->title }}" class="img-md">
                    </div>
                    <div class="text-center">
                        <p> <small>by.</small> <b>{{ $book->writer }}</b> <small>from</small>
                            <b>{{ $book->publisher }},
                                {{ $book->year }}</b></p>
                    </div>
                    <div class="mb-3">
                        <p class="font-weight-bold">Deskripsi</p>
                        <p>{!! $book->description !!}</p>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <p class="font-weight-bold">Kategori</p>
                            <p>{{ $book->name }}</p>
                        </div>
                        <div class="col-md-4">
                            <p class="font-weight-bold">Stok</p>
                            <p>{{ $book->stock }} Buah</p>
                        </div>
                        <div class="col-md-4">
                            <p class="font-weight-bold">Lokasi Penyimpanan</p>
                            <p>{{ $book->location }} (Lantai {{ $book->floor }})</p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection
