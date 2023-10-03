<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Alert;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        return view('pages.profile.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        return view('pages.profile.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'passowrd' => 'required'
        ]);

        DB::beginTransaction();

        try {
            User::find($id)->update([
                'name' => $request->name,
                'email'=> $request->email,
                'password' => Hash::make($request->password),
                'password_text' => $request->password
            ]);

            DB::commit();

            Alert::success('BERHASIL','Pembaharuan Data Pengguna Telah Berhasil');

            return redirect('/profile/show/'.Crypt::encryptString($id));
        } catch (\Throwable $th) {
            DB::rollback();

            return $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
