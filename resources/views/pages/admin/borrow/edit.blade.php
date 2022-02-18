@extends('layouts.admin')

@section('title', 'PerpustakaanXYZ | Ubah Peminjaman')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    {{-- breadcrumb --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Peminjaman</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ubah Peminjaman</li>
        </ol>
    </nav>

    {{-- content --}}
    <div class="card shadow-sm">
        <div class="container py-4">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800 text-center font-weight-bold">Ubah Peminjaman</h1>

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
                                        <a href="{{ route('user.show', $borrow->user_id) }}">
                                            {{ $borrow->name }}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Buku</th>
                                    <td>:</td>
                                    <td>
                                        <a href="{{ route('book.show', $borrow->book_id) }}">
                                            {{ $borrow->title }}
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="container border p-2">
                        <form action="{{ route('borrow.update', $borrow->id) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="date_start">Tanggal Peminjaman</label>
                                <input type="date" class="form-control" id="date_start" name="date_start"
                                    value="{{ old('date_start') ? old('date_start') : $borrow->date_start }}">
                                @error('date_start')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="date_end">Tanggal Pengembalian</label>
                                <input type="date" class="form-control" id="date_end" name="date_end"
                                    value="{{ old('date_end') ? old('date_end') : $borrow->date_end }}">
                                @error('date_end')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="is_finish">Status</label>
                                <select class="form-control" id="is_finish" name="is_finish">
                                    <option value="0"
                                        {{ (old('is_finish') ?? $borrow->is_finish) == '0' ? 'checked' : '' }}>Pinjam
                                    </option>
                                    <option value="1"
                                        {{ (old('is_finish') ?? $borrow->is_finish) == '1' ? 'checked' : '' }}>Selesai
                                    </option>
                                    @error('is_finish')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </select>
                            </div>
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </form>
                    </div>

                </div>

            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
    @endsection
