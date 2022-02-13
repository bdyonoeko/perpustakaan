<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = DB::table('books')
            ->join('categories', 'books.category_id', '=', 'categories.id')
            ->orderBy('title')
            ->get();

        return view('pages.admin.book.index', [
            'books' => $books
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // ambil data kategori
        $categories = DB::table('categories')
        ->orderBy('name')
        ->get();

        return view('pages.admin.book.create', [
            'categories' => $categories
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
            'title' => 'required',
            'writer' => 'required',
            'publisher' => 'required',
            'year' => 'required|numeric|min:4',
            'category_id' => 'required',
            'cover' => 'mimes:png,jpg,jpeg|max:2048',
            'stock' => 'required',
        ]);

        // ganti nama cover
        if ($request->hasfile('cover')) {
            $changeNameCover = uniqid('cvr-') . '.jpg';
        } else {
            $changeNameCover = 'default.jpg';
        }

        // data tambahan
        $addData = [
            'cover' => $changeNameCover,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // merge array
        $data = array_merge($validatedData, $addData);

        // simpan 
        DB::table('books')->insert($data);

        // pindahkan gambar
        if ($request->hasfile('cover')) {
            $request->cover->move('images/covers/', $changeNameCover);
        }

        return redirect()->route('book.index')->with('pesan', 'Tambah buku berhasil');
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
        DB::table('books')
        ->where('id', $id)
        ->delete();

        return redirect()->route('book.index')->with('pesan', 'Hapus buku berhasil');
    }
}
