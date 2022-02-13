<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = DB::table('categories')
            ->orderBy('name')
            ->get();

        return view('pages.admin.category.index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.category.create');
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
            'name' => 'required',
            'location' => 'required',
            'floor' => 'required',
        ]);

        // data tambahan
        $addData = [
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // merge array
        $data = array_merge($validatedData, $addData);

        // simpan 
        DB::table('categories')->insert($data);

        return redirect()->route('category.index')->with('pesan', 'Tambah kategori berhasil');
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
        // ambil data
        $category = DB::table('categories')
            ->where('id', $id)
            ->first();

        return view('pages.admin.category.edit', [
            'category' => $category
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
            'name' => 'required',
            'location' => 'required',
            'floor' => 'required',
        ]);

        // data tambahan
        $addData = [
            'updated_at' => now(),
        ];

        // merge array
        $data = array_merge($validatedData, $addData);

        // update 
        DB::table('categories')
        ->where('id', $id)
        ->update($data);

        return redirect()->route('category.index')->with('pesan', 'Ubah kategori berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('categories')
        ->where('id', $id)
        ->delete();

        return redirect()->route('category.index')->with('pesan', 'Hapus kategori berhasil');
    }
}
