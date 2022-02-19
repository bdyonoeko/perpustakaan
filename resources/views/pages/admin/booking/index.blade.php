@extends('layouts.admin')

@section('title', 'PerpustakaanXYZ | Peminjaman')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Konfirmasi Pinjaman</h1>

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

            {{-- table --}}
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Buku</th>
                            <th scope="col">Tanggal Booking</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($bookings as $booking)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $booking->name }}</td>
                            <td>{{ $booking->title }}</td>
                            <td>{{ date('d M Y', strtotime($booking->created_at)) }}</td>
                            <td class="text-center">

                                {{-- read --}}
                                <a href="{{ route('adminbooking.create', $booking->id) }}" class="btn btn-success mr-2"
                                    title="Buat Konfirmasi">
                                    <i class="fas fa-check"></i>
                                </a>

                                <!-- button delete modal -->
                                <button type="button" class="btn btn-danger btn-delete" data-toggle="modal"
                                    data-target="#deleteModalKonfirmasiPinjaman" data-id={{ $booking->id }}
                                    title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>

                            </td>
                        </tr>
                        @empty
                        <tr class="text-center">
                            <td colspan="5">Data tidak ditemukan</td>
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
@include('includes.deleteModal2')

{{-- melampirkan push css dan js datatables --}}
@include('includes.datatables')
