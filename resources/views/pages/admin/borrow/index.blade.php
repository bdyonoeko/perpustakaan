@extends('layouts.admin')

@section('title', 'PerpustakaanXYZ | Peminjaman')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    @if ($isFinish == '0')
    <h1 class="h3 mb-4 text-gray-800">Dalam Pinjaman</h1>
    @else
    <h1 class="h3 mb-4 text-gray-800">Riwayat Pinjaman</h1>
    @endif

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
                            <th>Nama</th>
                            <th>Buku</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Tanggal Deadline</th>

                            {{-- tanggal pengembalian hanya akan muncul di halaman daftar pinjaman yg selesai --}}
                            @if ($isFinish)
                            <th>Tanggal Pengembalian</th>
                            @endif

                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        {{-- tampil data --}}
                        @forelse ($borrows as $borrow)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $borrow->name }}</td>
                            <td>{{ $borrow->title }}</td>
                            <td>{{ date('d M Y', strtotime($borrow->date_start)) }}</td>
                            <td>{{ date('d M Y', strtotime($borrow->date_end)) }}</td>

                            {{-- tanggal pengembalian hanya akan muncul di halaman daftar pinjaman yg selesai --}}
                            @if ($isFinish)
                            <td>{{ date('d M Y', strtotime($borrow->updated_at)) }}</td>
                            @endif

                            <td>
                                @if ($borrow->is_finish == '0')
                                Pinjam
                                @else
                                Selesai
                                @endif
                            </td>
                            <td class="d-flex justify-content-center">


                                {{-- edit hanya akan muncul di daftar pinjaman yang masih dalam pinjaman --}}
                                @if ($isFinish == '0')
                                <a href="{{ route('borrow.edit', $borrow->id) }}" class="btn btn-secondary mr-2"
                                    title="Ubah">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @endif

                                <!-- button delete modal hanya akan muncul di daftar pinjaman yang sudah selesai -->
                                @if ($isFinish == '1')
                                <button type="button" class="btn btn-danger btn-delete" data-toggle="modal"
                                    data-target="#deleteModal" data-id={{ $borrow->id }} is-finish={{ $isFinish }}
                                    title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                                @endif

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

{{-- push script deleteJS --}}
@push('scripts')
<script>
    // menangkap nilai id lalu mengeneratenya ke dalam url action form 
    $('.btn-delete').click(function () {
        let idDelete = $(this).attr('data-id');
        let isFinish = $(this).attr('is-finish');
        $('#deleteForm').attr('action', '/borrow/' + idDelete + '/' + isFinish);
    })

    // jika ya ditekan, maka submit form
    $('#deleteForm [type="submit"]').click(function () {
        $('#deleteForm').submit();
    })

</script>
@endpush
