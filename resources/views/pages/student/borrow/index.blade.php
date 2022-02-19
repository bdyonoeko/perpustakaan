@extends('layouts.app')

@section('title', 'PerpustakaanXYZ | Peminjaman')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row justify-content-center">
        <div class="col-md-10">

            {{-- breadcrumb --}}
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Peminjaman</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Daftar Peminjaman</li>
                </ol>
            </nav>

            {{-- content --}}
            <div class="card shadow-sm">
                <div class="container py-4">

                    {{-- table --}}
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Sampul</th>
                                    <th>Judul</th>
                                    <th>Tanggal Deadline</th>
                                </tr>
                            </thead>
                            <tbody>

                                {{-- tampil data --}}
                                @forelse ($borrows as $borrow)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ asset('images/covers/' . $borrow->cover) }}"
                                            alt="{{ $borrow->title }}" class="img-sm">
                                    </td>
                                    <td>{{ $borrow->title }}</td>
                                    <td>{{ date('d M Y', strtotime($borrow->date_end)) }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada data</td>
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

{{-- melampirkan push css dan js datatables --}}
@include('includes.datatables')
