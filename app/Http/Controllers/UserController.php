<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($isConfirmation)
    {
        $users = DB::table('users')
            ->where('is_confirmation', $isConfirmation)
            ->where('role', '!=', 'Admin')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.admin.user.index', [
            'users' => $users,
            'isConfirmation' => $isConfirmation,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = DB::table('users')
            ->where('id', $id)
            ->first();

        return view('pages.admin.user.show', [
            'user' => $user,
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
        // cek role
        if (Auth::user()->role == 'Admin') {
            // konfirmasi user lalu akan redirect ke hal. admin
            DB::table('users')
                ->where('id', $id)
                ->update(['is_confirmation' => '1']);
    
            return redirect()->route('user.index', $isConfirmation='1')->with('pesan', 'Konfirmasi mahasiswa berhasil');
        } else {

            // jika mahasiswa, ia akan merubah data miliknya dan redirect ke mahasiswa
            // validasi
            $validatedData = $request->validate([
                'nim' => ['required', 'string', 'max:8', 'min:8', 'unique:users'],
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'gender' => ['required']
            ]);

            // photo
            if ($request->hasfile('photo')) {
                // ganti nama
                $changeNamePhoto = uniqid('pht-') . '.jpg';
                // pindahkan file
                $request->photo->move('images/profiles/', $changeNamePhoto);
                // hapus file lama
                if ($request->photoOld != 'default.jpg') {
                    File::delete('images/profiles/' . $request->photoOld);
                }
            } else {
                $changeNamePhoto = $request->photoOld;
            }

            // data tambahan
            $addData = [
                'photo' => $changeNamePhoto,
                'updated_at' => now(),
            ];

            // merge array
            $data = array_merge($validatedData, $addData);

            // update
            DB::table('users')
                ->where('id', $id)
                ->update($data);

            return redirect()->route('user.show')->with('pesan', 'Perubahan data berhasil');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $isConfirmation)
    {
        // ambil data user
        $user = DB::table('users')
            ->where('id', $id)
            ->first();

        // hapus file cover
        if ($user->photo != 'default.jpg') {
            File::delete('images/profiles/' . $user->cover);
        }

        // hapus data user
        DB::table('users')
            ->where('id', $id)
            ->delete();

        return redirect()->route('user.index', $isConfirmation=$isConfirmation)->with('pesan', 'Hapus mahasiswa berhasil');
    }
}
