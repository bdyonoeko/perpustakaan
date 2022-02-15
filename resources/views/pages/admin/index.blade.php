@extends('layouts.admin')

@section('title', 'PerpustakaanXYZ | Dashboard')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Buku -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Buku
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalBook }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-book fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mahasiswa -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Mahasiswa
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($totalUser) }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-graduation-cap fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Peminjaman -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Peminjaman
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-handshake fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->

<div class="row">

    <!-- Konfirmasi Peminjaman -->
    <div class="col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Peminjaman Butuh Konfirmasi</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-dark">Mahasiswa Butuh Konfirmasi (<a
                        href="{{ route('user.index', $isConfirmation='0') }}">More...</a>)</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($userNotConfirmed as $user)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $user->name }}</td>
                            <td>

                                {{-- read --}}
                                <a href="{{ route('user.show', $user->id) }}" class="btn btn-info mr-2" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <!-- button delete modal -->
                                <button type="button" class="btn btn-danger btn-delete" data-toggle="modal"
                                    data-target="#deleteModal" data-id={{ $user->id }} title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>

                            </td>
                        </tr>
                        @empty
                        <tr class="text-center">
                            <td colspan="3">Data tidak ditemukan</td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection


{{-- melampirkan push deleteModal --}}
@include('includes.deleteModal')

{{-- push script deleteJS --}}
@push('scripts')
<script>
    // menangkap nilai id lalu mengeneratenya ke dalam url action form 
    $('.btn-delete').click(function () {
        let idDelete = $(this).attr('data-id');
        $('#deleteForm').attr('action', '/user/' + idDelete);
    })

    // jika ya ditekan, maka submit form
    $('#deleteForm [type="submit"]').click(function () {
        $('#deleteForm').submit();
    })

</script>
@endpush
