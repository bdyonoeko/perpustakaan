@extends('layouts.admin')

@section('title', 'PerpustakaanXYZ | User')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    @if ($isConfirmation == false)
    <h1 class="h3 mb-4 text-gray-800">Daftar Mahasiswa Butuh Konfirmasi</h1>
    @else
    <h1 class="h3 mb-4 text-gray-800">Daftar Mahasiswa Terkonfirmasi</h1>
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
                            <th>Foto</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        {{-- tampil data --}}
                        @forelse ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ asset('images/profiles/' . $user->photo) }}" alt="{{ $user->name }}"
                                    class="img-rounded img-profile-sm">
                            </td>
                            <td>{{ $user->nim }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="d-flex justify-content-center">

                                {{-- read --}}
                                <a href="{{ route('user.show', $user->id) }}" class="btn btn-info mr-2" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <!-- button delete modal -->
                                <button type="button" class="btn btn-danger btn-delete" data-toggle="modal"
                                    data-target="#deleteModal" data-id={{ $user->id }}
                                    is-confirmation={{ $user->is_confirmation }} title="Hapus">
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

{{-- push script deleteJS --}}
@push('scripts')
<script>
    // menangkap nilai id lalu mengeneratenya ke dalam url action form 
    $('.btn-delete').click(function () {
        let idDelete = $(this).attr('data-id');
        let isConfirmation = $(this).attr('is-confirmation');
        $('#deleteForm').attr('action', '/user/' + idDelete + '/' + isConfirmation);
    })

    // jika ya ditekan, maka submit form
    $('#deleteForm [type="submit"]').click(function () {
        $('#deleteForm').submit();
    })

</script>
@endpush
