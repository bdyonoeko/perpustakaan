<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        // hitung total buku
        $totalBook = DB::table('books')->sum('stock');

        // hitung total student
        $totalUser = DB::table('users')
            ->where('role', '!=', 'Admin')
            ->get();
        
        // hitung total peminjaman
        $totalBorrow = DB::table('borrows')
            ->where('is_finish', '0')
            ->get();

        // ambil data student yang belum dikonfirmasi
        $userNotConfirmed = DB::table('users')
            ->where('is_confirmation', '==', false)
            ->where('role', '!=', 'Admin')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // ambil data booking yang belum dikonfirmasi
        $bookingNotConfirmed = DB::table('bookings')
            ->select('bookings.*', 'users.name as name', 'books.title as title')
            ->join('users', 'bookings.user_id', '=', 'users.id')
            ->join('books', 'bookings.book_id', '=', 'books.id')
            ->where('is_confirmation_admin', 0)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();


        return view('pages.admin.index', [
            'totalBook' => $totalBook,
            'totalUser' => $totalUser,
            'totalBorrow' => $totalBorrow,
            'userNotConfirmed' => $userNotConfirmed,
            'bookingNotConfirmed' => $bookingNotConfirmed,
        ]);
    }
}
