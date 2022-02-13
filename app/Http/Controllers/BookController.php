<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ambil data buku-buku
        $books = DB::table('books')
            ->select('books.*', 'categories.name as name')
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
        // ambil data kategori-kategori
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

        // cover
        if ($request->hasfile('cover')) {
            // ganti nama
            $changeNameCover = uniqid('cvr-') . '.jpg';
            // pindahkan file
            $request->cover->move('images/covers/', $changeNameCover);
        } else {
            $changeNameCover = 'default.jpg';
        }

        // description
        if ($request->description == null) {
            $description = 'Deskripsi buku belum dibuat';
        } else {
            $description = $request->description;
        }

        // data tambahan
        $addData = [
            'description' => $description,
            'cover' => $changeNameCover,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // merge array
        $data = array_merge($validatedData, $addData);

        // simpan 
        DB::table('books')->insert($data);

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
        // ambil data buku-buku
        $book = DB::table('books')
            ->select('books.*', 'categories.name as name', 'categories.location as location', 'categories.floor as floor')
            ->join('categories', 'books.category_id', '=', 'categories.id')
            ->where('books.id', $id)
            ->first();

        return view('pages.admin.book.show', [
            'book' => $book
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
        // ambil data buku
        $book = DB::table('books')
            ->where('id', $id)
            ->first();

        // ambil data kategori-kategori
        $categories = DB::table('categories')
            ->orderBy('name')
            ->get();

        return view('pages.admin.book.edit', [
            'book' => $book,
            'categories' => $categories
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
            'title' => 'required',
            'writer' => 'required',
            'publisher' => 'required',
            'year' => 'required|numeric|min:4',
            'category_id' => 'required',
            'cover' => 'mimes:png,jpg,jpeg|max:2048',
            'stock' => 'required',
        ]);

        // cover
        if ($request->hasfile('cover')) {
            // ganti nama
            $changeNameCover = uniqid('cvr-') . '.jpg';
            // pindahkan file
            $request->cover->move('images/covers/', $changeNameCover);
            // hapus file cover lama
            if ($request->coverOld != 'default.jpg') {
                File::delete('images/covers/' . $request->coverOld);
            }
        } else {
            $changeNameCover = $request->coverOld;
        }

        // description
        if ($request->description == null) {
            $description = 'Deskripsi buku belum dibuat';
        } else {
            $description = $request->description;
        }

        // data tambahan
        $addData = [
            'description' => $description,
            'cover' => $changeNameCover,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // merge array
        $data = array_merge($validatedData, $addData);

        // update 
        DB::table('books')
            ->where('id', $id)
            ->update($data);

        return redirect()->route('book.index')->with('pesan', 'Ubah buku berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // ambil data buku
        $book = DB::table('books')
            ->where('id', $id)
            ->first();

        // hapus file cover
        if ($book->cover != 'default.jpg') {
            File::delete('images/covers/' . $book->cover);
        }

        // hapus data buku
        DB::table('books')
            ->where('id', $id)
            ->delete();

        return redirect()->route('book.index')->with('pesan', 'Hapus buku berhasil');
    }
}
