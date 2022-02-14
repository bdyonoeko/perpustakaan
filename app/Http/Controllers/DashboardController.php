<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        // hitung total buku
        $totalBuku = DB::table('books')->sum('stock');

        return view('pages.admin.index', [
            'totalBuku' => $totalBuku,
        ]);
    }
}
