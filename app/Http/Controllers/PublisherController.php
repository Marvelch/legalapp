<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;
use DB;
use Alert;
use App\DataTables\PublisherDataTable;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index(PublisherDataTable $dataTable)
    {
        // return view('pages.legal.index',compact('items'));
        return $dataTable->render('pages.publisher.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.publisher.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|unique:legal_entities|min:2|max:255',
            'address'       => 'required|min:2|max:255',
            'phone'         => 'required',
        ]);

        DB::beginTransaction();

        try {
            Publisher::create([
                'name' => strtolower($request->name),
                'address' => strtolower($request->address),
                'phone' => $request->phone
            ]);

            DB::commit();
            Alert::success('SUCCEED','Successfully save data to system');

            return back();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();

            Alert::error('FAIL','Failed to save because we ran into a problem');
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Publisher $publisher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publisher $publisher, $id)
    {
        $items = Publisher::find($id);

        return view('pages.publisher.edit',compact('items'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'          => 'required|min:2|max:255',
            'address'       => 'required|min:2|max:255',
            'phone'         => 'required',
        ]);

        DB::beginTransaction();

        try {
            Publisher::find($id)->update([
                'name' => strtolower($request->name),
                'address' => strtolower($request->address),
                'phone' => $request->phone
            ]);

            DB::commit();
            Alert::success('SUCCEED','Data update has been successful');

            return redirect()->route('index_publisher');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();

            Alert::error('FAIL','Failed to save because we ran into a problem');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publisher $publisher)
    {
        //
    }
}
