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
    public function index($isFinish)
    {
        // ambil data peminjaman yang masih dalam peminjaman
        $borrows = DB::table('bookings')
            ->select('borrows.*', 'users.name as name', 'books.title as title')
            ->join('borrows', 'bookings.id', '=', 'borrows.booking_id')
            ->join('users', 'bookings.user_id', '=', 'users.id')
            ->join('books', 'bookings.book_id', '=', 'books.id')
            ->where('borrows.is_finish', $isFinish)
            ->get();

        return view('pages.admin.borrow.index', [
            'borrows' => $borrows,
            'isFinish' => $isFinish,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
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

        // data yang akan di update ditable booking
        $dataUpdateBooking = [
            'is_confirmation_admin' => 1,
            'updated_at' => now(),
        ];

        // simpan update data booking
        DB::table('bookings')
            ->where('id', $request->booking_id)
            ->update($dataUpdateBooking);

        return redirect()->route('borrow.index', '0')->with('pesan', 'Konfirmasi pinjaman berhasil');
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
        $borrow = DB::table('bookings')
            ->select('borrows.*', 'users.name as name', 'books.title as title', 'users.id as user_id', 'books.id as book_id')
            ->join('users', 'bookings.user_id', '=', 'users.id')
            ->join('books', 'bookings.book_id', '=', 'books.id')
            ->join('borrows', 'bookings.id', '=', 'borrows.booking_id')
            ->where('borrows.id', $id)
            ->first();

        return view('pages.admin.borrow.edit', [
            'borrow' => $borrow
        ]);
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
        // validasi
        $validatedData = $request->validate([
            'date_start' => 'required',
            'date_end' => 'required',
            'is_finish' => 'required',
        ]);

        // data tambahan 
        $addData = [
            'updated_at' => now(),
        ];

        // merge array
        $data = array_merge($validatedData, $addData);

        DB::table('borrows')
            ->where('id', $id)
            ->update($data);

        // get status
        $isFinish = $request->is_finish;

        // get total stok buku untuk mengembalikan stock buku
        $book = DB::table('bookings')
            ->select('books.stock as stock', 'books.id as book_id')
            ->join('borrows', 'bookings.id', '=', 'borrows.booking_id')
            ->join('books', 'bookings.book_id', '=', 'books.id')
            ->where('borrows.id', $id)
            ->first();

        // tambah stok buku
        $stock = [
            'stock' => $book->stock + 1
        ];

        // mengembalikan stok buku
        if ($isFinish == '1') {
            DB::table('books')
                ->where('id', $book->book_id)
                ->update($stock);
        }

        // redirect ke halaman pinjaman yg belum selesai
        return redirect()->route('borrow.index', '0')->with('pesan', 'Ubah pinjaman berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $isFinish)
    {
        // ambil data pinjaman untuk mendapatkan data booking
        $borrow = DB::table('borrows')
            ->where('id', $id)
            ->first();

        // hapus data booking di table booking
        DB::table('bookings')
            ->where('id', $borrow->booking_id)
            ->delete();

        // hapus data pinjaman
        DB::table('borrows')
            ->where('id', $id)
            ->delete();

        return redirect()->route('borrow.index', $isFinish)->with('pesan', 'Hapus pinjaman berhasil');
    }
}
