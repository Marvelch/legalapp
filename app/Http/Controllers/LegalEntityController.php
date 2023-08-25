<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\LegalEntity;
use Illuminate\Http\Request;
use Alert;
use DB;
use App\DataTables\LegalEntityDataTable;
use App\Models\Company;
use Yajra\DataTables\Facades\DataTables;

class LegalEntityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(LegalEntityDataTable $dataTable)
    {
        // return view('pages.legal.index',compact('items'));
        return $dataTable->render('pages.legal.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items = Division::all();

        return view('pages.legal.create',compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|unique:legal_entities|min:2|max:255',
            'address'       => 'required|min:2|max:255',
            'description'   => 'max:500',
        ]);

        DB::beginTransaction();

        try {
            LegalEntity::create([
                'name' => strtolower($request->name),
                'address' => strtolower($request->address),
                'division_id' => $request->division,
                'description' => strtolower($request->description)
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
    public function show(LegalEntity $legalEntity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LegalEntity $legalEntity, $id)
    {
        $legal = LegalEntity::find($id);
        $devision = Division::all();

        return view('pages.legal.edit',compact('legal','devision'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'name'          => 'required|min:2|max:255',
            'address'       => 'required|min:2|max:255',
            'description'   => 'max:500',
        ]);

        DB::beginTransaction();

        try {
            LegalEntity::find($id)->update([
                'name' => strtolower($request->name),
                'address' => strtolower($request->address),
                'division_id' => $request->division,
                'description' => strtolower($request->description)
            ]);

            DB::commit();
            Alert::success('SUCCEED','Data update has been successful');

            return redirect()->route('index_legal');
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
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            LegalEntity::find($id)->delete();
            
            DB::commit();
            Alert::success('SUCCEED','Data deletion has been successful');

            return back();
        } catch (\Throwable $th) {
             DB::rollback();

            Alert::error('FAIL','Failed to delete data, please check again');
            return back();
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function legalTable()
    {
        $model = LegalEntity::query();
            return DataTables::eloquent($model)
            ->addColumn('action',function($model){
            $btn = '<div class="d-flex justify-content-center"><a href="javascript:void(0)" class="btn btn-primary btn-sm m-1"><i class="ti ti-eye"></i></a><button type="button" class="btn btn-danger btn-sm m-1" data-bs-toggle="modal" data-bs-target="#modalDelete'.$model->id.'"><i class="ti ti-trash"></i></button></div>
                    <!-- Modal -->
                        <div class="modal fade" id="modalDelete'.$model->id.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-4">
                                        <img src="https://cdn3d.iconscout.com/3d/premium/thumb/alert-notification-8400231-6672344.png" style="width: 100%;"/>
                                    </div>
                                    <div class="col-8 text-center align-self-center text-uppercase">
                                        <span>Konfirmasi Penghapusan Data Dari Layanan Legal</span><br>
                                        <span class="fw-bold">'.$model->name.'</span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary text-sm" data-bs-dismiss="modal">Batal</button>
                                <a href="/legal/delete/'.$model->id.'" class="btn btn-danger text-sm">Hapus</a>
                            </div>
                            </div>
                        </div>
                        </div>
                        ';
            return $btn;
        })
        ->addColumn('divisions', '{{$model->legals->name}}')
        ->rawColumns(['action'])
        ->toJson();
    }
}
