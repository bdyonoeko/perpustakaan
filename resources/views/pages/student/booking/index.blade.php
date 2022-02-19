@extends('layouts.app')

@section('title', 'PerpustakaanXYZ | Booking')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row justify-content-center">
        <div class="col-md-10">

            {{-- breadcrumb --}}
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Booking</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Daftar Booking</li>
                </ol>
            </nav>

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
                                    <th>#</th>
                                    <th>Sampul</th>
                                    <th>Judul</th>
                                    <th>Penulis</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                {{-- tampil data --}}
                                @forelse ($bookings as $booking)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ asset('images/covers/' . $booking->cover) }}"
                                            alt="{{ $booking->title }}" class="img-sm">
                                    </td>
                                    <td>{{ $booking->title }}</td>
                                    <td>{{ $booking->writer }}</td>
                                    <td class=" d-flex justify-content-center">

                                        {{-- confirm --}}
                                        <form action="{{ route('booking.update', $booking->id) }}" method="post">
                                            @csrf
                                            @method('put')

                                            <button type="submit" class="btn btn-success mr-2" title="Konfirmasi">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>

                                        {{-- read --}}
                                        <a href="{{ route('booking.show', $booking->book_id) }}"
                                            class="btn btn-info mr-2" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <!-- button delete modal -->
                                        <button type="button" class="btn btn-danger btn-delete" data-toggle="modal"
                                            data-target="#deleteModal" data-id={{ $booking->id }} title="Hapus">
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
    </div>

</div>
<!-- /.container-fluid -->
@endsection

{{-- melampirkan push deleteModal --}}
@include('includes.deleteModal')

{{-- melampirkan push css dan js datatables --}}
@include('includes.datatables')

{{-- push script deleteJS --}}
@push('scripts')
<script>
    // menangkap nilai id lalu mengeneratenya ke dalam url action form 
    $('.btn-delete').click(function () {
        let idDelete = $(this).attr('data-id');
        $('#deleteForm').attr('action', '/booking/' + idDelete);
    })

    // jika ya ditekan, maka submit form
    $('#deleteForm [type="submit"]').click(function () {
        $('#deleteForm').submit();
    })

</script>
@endpush
