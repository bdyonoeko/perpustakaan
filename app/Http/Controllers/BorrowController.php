<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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

        return view('pages.admin.borrow.create', [
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
        // validasi
        $validatedData = $request->validate([
            'date_start' => 'required',
            'date_end' => 'required',
        ]);

        // data tambahan 
        $addData = [
            'booking_id' => $request->booking_id,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // merge array
        $data = array_merge($validatedData, $addData);

        // simpan
        DB::table('borrows')->insert($data);

        // update table bookings
        DB::table('bookings')
            ->where('id', $request->booking_id)
            ->update(['is_confirmation_admin' => 1]);

        return redirect()->route('borrow.index')->with('pesan', 'Konfirmasi pinjaman berhasil');
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
        //
    }

    public function booking() {
        // ambil data booking yang belum dikonfirmasi admin
        $bookings = DB::table('bookings')
            ->where('is_confirmation_admin', 0)
            ->get();

        return view('pages.admin.borrow.booking', [
            'bookings' => $bookings
        ]);
    }
}
