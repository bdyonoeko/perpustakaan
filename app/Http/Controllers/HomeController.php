<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // cek user login dan lempar ke halaman yg seharusnya
        if (Auth::user() && Auth::user()->role == 'Admin') {
            return redirect()->route('dashboard');
        }

        // ambil data buku-buku
        $books = DB::table('books')
            ->orderBy('title')
            ->get();

        return view('pages.student.index', [
            'books' => $books,
        ]);
    }

    public function edit($id)
    {
        $user = DB::table('users')
            ->where('id', $id)
            ->first();

        return view('pages.student.user.edit', [
            'user' => $user,
        ]);
    }

    public function show($id)
    {
        $user = DB::table('users')
            ->where('id', $id)
            ->first();


        return view('pages.student.user.show', [
            'user' => $user,
        ]);
    }
}
