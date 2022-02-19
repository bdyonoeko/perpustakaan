<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function __construct()
    {
        // memasang middleware kecuali untuk function show
        $this->middleware('auth')->except('show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = DB::table('bookings')
            ->select('bookings.*', 'books.title as title', 'books.cover as cover', 'books.writer as writer')
            ->join('books', 'books.id', '=', 'bookings.book_id')
            ->where('user_id', Auth::id())
            ->where('is_confirmation_user', '0')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.student.booking.index', [
            'bookings' => $bookings,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->is_confirmation == '0') {
            return redirect()->route('home')->with('pesan', 'Booking tidak bisa dilakukan. Akun anda belum dikonfirmasi oleh admin. Harap menunggu!');
        }

        // ambil data
        $data = [
            'book_id' => $request->book_id,
            'user_id' => Auth::id(),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // simpan data
        DB::table('bookings')->insert($data);

        // ambil data buku untuk dilakukan pengurangan stock
        $book = DB::table('books')
            ->where('id', $request->book_id)
            ->first();

        // kurangi stock
        $stock = $book->stock - 1;

        // update stock di table books
        DB::table('books')
            ->where('id', $request->book_id)
            ->update(['stock' => $stock]);

        return redirect()->route('booking.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // ambil data buku-buku
        $book = DB::table('books')
            ->select('books.*', 'categories.name as name', 'categories.location as location', 'categories.floor as floor')
            ->join('categories', 'books.category_id', '=', 'categories.id')
            ->where('books.id', $id)
            ->first();

        return view('pages.student.booking.show', [
            'book' => $book,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // update is_confirmation_user di table bookings
        DB::table('bookings')
            ->where('id', $id)
            ->update(['is_confirmation_user' => 1]);

        return redirect()->route('booking.index')->with('pesan', 'Konfirmasi booking berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // ambil data booking untuk mendapatkan data buku yang di booking
        $booking = DB::table('bookings')
            ->where('id', $id)
            ->first();

        // ambil data buku untuk mengurangi stock
        $book = DB::table('books')
            ->where('id', $booking->book_id)
            ->first();

        // tambah stock
        $stock = $book->stock + 1;

        // update stock di table books
        DB::table('books')
            ->where('id', $booking->book_id)
            ->update(['stock' => $stock]);

        // hapus data booking
        DB::table('bookings')
            ->where('id', $id)
            ->delete();

        return redirect()->route('booking.index')->with('pesan', 'Hapus booking berhasil');
    }
}
