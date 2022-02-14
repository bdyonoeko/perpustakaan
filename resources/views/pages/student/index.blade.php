@extends('layouts.app')

@section('title', 'PerpustakaanXYZ | Home')

@section('content')
<div class="container pt-4">

    <div class="row g-4 justify-content-center">
        @forelse ($books as $book)
        <div class="col-lg-3 col-md-6">
            <div class="card text-center card-effect">
                <img src="{{ asset('images/covers/' . $book->cover) }}"
                    class="card-img-top pt-4 px-4 pb-2 img-width-responsive">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold">{{ $book->title }}</h5>
                    <small class="card-text">by. <b>{{ $book->writer }}</b> from <b>{{ $book->publisher }}</b>,
                        <b>{{ $book->year }}</b></small>
                    <a href="#" class="btn btn-primary d-flex justify-content-center mt-3">Booking</a>
                    <a href="{{ route('booking.show', $book->id) }}"
                        class="btn btn-secondary d-flex justify-content-center mt-2">Detail</a>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center">
            <div class="alert alert-warning" role="alert">
                <p>Data tidak ditemukan</p>
            </div>
        </div>
        @endforelse

    </div>

</div>
@endsection
