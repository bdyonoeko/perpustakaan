@extends('layouts.admin')

@section('title', 'PerpustakaanXYZ | Buku')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Daftar Buku</h1>

    {{-- content --}}
    <div class="card shadow-sm">
        <div class="container py-4">

            {{-- button --}}
            <a href="{{ route('book.create') }}" class="btn btn-primary mb-3">Tambah Buku</a>

            {{-- table --}}
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Sampul</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Kategori</th>
                            <th>Tahun</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        {{-- tampil data --}}
                        @forelse ($books as $book)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ asset('images/covers/' . $book->cover) }}" alt="{{ $book->title }}"
                                    style="width: 70px; height: 100px">
                            </td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->writer }}</td>
                            <td>{{ $book->name }}</td>
                            <td>{{ $book->year }}</td>
                            <td>{{ $book->stock }}</td>
                            <td class="d-flex justify-content-center">

                                {{-- read --}}
                                <a href="{{ route('book.show', $book->id) }}" class="btn btn-info mr-2" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>

                                {{-- edit --}}
                                <a href="{{ route('book.edit', $book->id) }}" class="btn btn-secondary mr-2"
                                    title="Ubah">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- button delete modal -->
                                <button type="button" class="btn btn-danger btn-delete" data-toggle="modal"
                                    data-target="#deleteModal" data-id={{ $book->id }} title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada data</td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection

{{-- melampirkan push deleteModal --}}
@include('includes.deleteModal')

{{-- melampirkan push css dan js datatables --}}
@include('includes.datatables')
