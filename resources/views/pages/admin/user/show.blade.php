@extends('layouts.admin')

@section('title', 'PerpustakaanXYZ | Detail Mahasiswa')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    {{-- breadcrumb --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a
                    href="{{ $user->is_confirmation == '0' ? route('user.index', $isConfirmation='0') : route('user.index', $isConfirmation='1') }}">Mahasiswa</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Detail Mahasiswa</li>
        </ol>
    </nav>

    {{-- content --}}
    <div class="card shadow-sm">
        <div class="container py-4">

            {{-- page heading --}}
            <h1 class="h3 font-weight-bold text-gray-800 mb-4 text-center">{{ $user->name }}</h1>

            <div class="row justify-content-center mb-4">
                <div class="col-md-8">

                    {{-- gambar --}}
                    <div class="mb-4 text-center">
                        <img src="{{ asset('images/profiles/' . $user->photo) }}" alt="{{ $user->name }}"
                            class="img-rounded">
                    </div>

                    {{-- detail --}}
                    <div class="table-responsive mb-4">
                        <table class="table table-hover">

                            <tbody>
                                <tr>
                                    <th scope="row">NIM</th>
                                    <td>:</td>
                                    <td>{{ $user->nim }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Email</th>
                                    <td>:</td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Jenis Kelamin</th>
                                    <td>:</td>
                                    <td>{{ $user->gender }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Tanggal Bergabung</th>
                                    <td>:</td>
                                    <td>{{ date('d M Y', strtotime($user->created_at))  }} </td>
                                </tr>
                            </tbody>

                        </table>

                        {{-- tombol konfirmasi --}}
                        @if ($user->is_confirmation == false)
                        <div class="text-center">
                            <form action="{{ route('user.update', $user->id) }}" method="post">
                                @csrf
                                @method('put')
                                <button type="submit" class="btn btn-success">
                                    Konfirmasi
                                </button>
                            </form>
                        </div>
                        @endif

                    </div>

                </div>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection
