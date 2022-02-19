@extends('layouts.app')

@section('title', 'PerpustakaanXYZ | Detail User')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    {{-- content --}}
    <div class="row justify-content-center">
        <div class="col-md-8">

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
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection
