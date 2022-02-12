@extends('layouts.admin')

@section('title', 'PerpustakaanXYZ | Kategori')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Daftar Kategori</h1>

    {{-- content --}}
    <div class="card shadow-sm">
        <div class="container py-4">

            {{-- pesan --}}
            @if (session()->has('pesan'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('pesan') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            {{-- button --}}
            <a href="{{ route('category.create') }}" class="btn btn-primary mb-3">Tambah Kategori</a>

            {{-- table --}}
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Lokasi</th>
                            <th>Lantai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        {{-- tampil data --}}
                        @forelse ($categories as $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->location }}</td>
                            <td>{{ $category->floor }}</td>
                            <td class="d-flex justify-content-center">

                                {{-- edit --}}
                                <a href="{{ route('category.edit', $category->id) }}" class="btn btn-secondary mr-2"
                                    title="Ubah">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- button delete modal -->
                                <button type="button" class="btn btn-danger btn-delete" data-toggle="modal"
                                    data-target="#deleteModal" data-id={{ $category->id }} title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data</td>
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
