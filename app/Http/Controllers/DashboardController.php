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

        // ambil data student yang belum dikonfirmasi
        $userNotConfirmed = DB::table('users')
            ->where('is_confirmation', '==', false)
            ->where('role', '!=', 'Admin')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('pages.admin.index', [
            'totalBook' => $totalBook,
            'totalUser' => $totalUser,
            'userNotConfirmed' => $userNotConfirmed,
        ]);
    }
}
