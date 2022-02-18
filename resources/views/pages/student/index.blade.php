@extends('layouts.app')

@section('title', 'PerpustakaanXYZ | Home')

@section('content')
<div class="container pt-4">

    {{-- pesan --}}
    @if (session()->has('pesan'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session()->get('pesan') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

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


                    {{-- tombol booking --}}
                    @if ($book->stock == 0)
                    <a href="#" class="btn btn-danger d-flex mt-3 justify-content-center disabled">Booking Penuh</a>
                    @else
                    <form action="{{ route('booking.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                        <button type="submit"
                            class="btn btn-primary d-flex w-100 justify-content-center mt-3">Booking</button>
                    </form>
                    @endif

                    {{-- tombol detail  --}}
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
