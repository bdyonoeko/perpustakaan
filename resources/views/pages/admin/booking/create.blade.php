@extends('layouts.admin')

@section('title', 'PerpustakaanXYZ | Konfirmasi Booking')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    {{-- breadcrumb --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('adminbooking.index') }}">Booking</a></li>
            <li class="breadcrumb-item active" aria-current="page">Buat Konfirmasi</li>
        </ol>
    </nav>

    {{-- content --}}
    <div class="card shadow-sm">
        <div class="container py-4">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800 text-center font-weight-bold">Buat Konfirmasi</h1>

            <div class="row justify-content-center mb-4">

                <div class="col-md-10">

                    {{-- detail --}}
                    <div class="table-responsive mb-4">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th scope="row">Nama</th>
                                    <td>:</td>
                                    <td>
                                        <a href="{{ route('user.show', $booking->user_id) }}">
                                            {{ $booking->name }}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Buku</th>
                                    <td>:</td>
                                    <td>
                                        <a href="{{ route('book.show', $booking->book_id) }}">
                                            {{ $booking->title }}
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="container border p-2">
                        <form action="{{ route('borrow.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="date_start">Tanggal Peminjaman</label>
                                <input type="date" class="form-control" id="date_start" name="date_start"
                                    value="{{ old('date_start') }}">
                                @error('date_start')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="date_end">Tanggal Pengembalian</label>
                                <input type="date" class="form-control" id="date_end" name="date_end"
                                    value="{{ old('date_end') }}">
                                @error('date_end')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                            <button class="btn btn-success" type="submit">Konfirmasi</button>
                        </form>
                    </div>

                </div>

            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
    @endsection
