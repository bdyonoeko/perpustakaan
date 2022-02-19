<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentBorrowController extends Controller
{
    public function index() {
        // ambil data peminjaman yang dilakukan user
        $borrows = DB::table('borrows')
            ->select('borrows.*', 'books.title as title', 'books.cover as cover')
            ->join('bookings', 'borrows.booking_id', '=', 'bookings.id')
            ->join('books', 'bookings.book_id', '=', 'books.id')
            ->where('bookings.user_id', Auth::id())
            ->where('borrows.is_finish', '0')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.student.borrow.index', [
            'borrows' => $borrows,
        ]);
    }
}
