<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ambil data booking yang belum dikonfirmasi
        $bookings = DB::table('bookings')
            ->select('bookings.*', 'users.name as name', 'books.title as title')
            ->join('users', 'bookings.user_id', '=', 'users.id')
            ->join('books', 'bookings.book_id', '=', 'books.id')
            ->where('is_confirmation_admin', 0)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.admin.booking.index', [
            'bookings' => $bookings
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $booking = DB::table('bookings')
            ->select('bookings.*', 'users.name as name', 'books.title as title')
            ->join('users', 'bookings.user_id', '=', 'users.id')
            ->join('books', 'bookings.book_id', '=', 'books.id')
            ->where('bookings.id', $id)
            ->first();

        return view('pages.admin.booking.create', [
            'booking' => $booking
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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

        // ambil data buku untuk mengembalikan stock
        $book = DB::table('books')
            ->where('id', $booking->book_id)
            ->first();

        // tambah stock
        $stock = $book->stock + 1;

        // update stock di table books
        DB::table('books')
            ->where('id', $booking->book_id)
            ->update(['stock' => $stock]);

        // hapus data pinjaman yang belum dikonfirmasi
        DB::table('bookings')
            ->where('id', $id)
            ->delete();

        return redirect()->route('adminbooking.index')->with('pesan', 'Hapus konfirmasi pinjaman berhasil');
    }
}
