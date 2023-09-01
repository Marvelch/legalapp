<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\LegalEntity;
use Illuminate\Http\Request;
use Alert;
use DB;
use App\DataTables\LegalEntityDataTable;
use App\Models\Company;
use App\Models\Licensing;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Auth;

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
            'division'      => 'required',
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

            return redirect()->route('index_legal');
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
    public function show($id)
    {
        $legal = LegalEntity::find(Crypt::decryptString($id));

        return view('pages.legal.show',compact('legal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LegalEntity $legalEntity, $id)
    {
        $legal = LegalEntity::find(Crypt::decryptString($id));
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
            $checkLegal = Licensing::where('legal_entity_id',$id)->first();

            if($checkLegal) {
                DB::rollback();
                Alert::info('CANT','Deletion not allowed, has been used');

                return back();
            }else{
                LegalEntity::find($id)->delete();
            }
            
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
            $btn = '<div class="d-flex justify-content-center"><a href="/legal/show/'.Crypt::encryptString($model->id).'" class="btn btn-primary btn-sm m-1"><i class="ti ti-eye"></i></a><a href="/legal/edit/'.Crypt::encryptString($model->id).'" class="btn btn-success btn-sm m-1" style="color: white"><i class="ti ti-pencil"></i></a><button type="button" class="btn btn-danger btn-sm m-1" data-bs-toggle="modal" data-bs-target="#modalDelete'.$model->id.'"><i class="ti ti-trash"></i></button></div>
                    <!-- Modal -->
                        <div class="modal fade" id="modalDelete'.$model->id.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-center">
                                        <img src="https://cdn3d.iconscout.com/3d/premium/thumb/alert-notification-8400231-6672344.png" width="20%"/>
                                    </div>
                                    <div class="col-12 text-smt text-center">
                                        <div class="from group mb-3">
                                            <h5 class="mt-2">'.$model->name.'</h5>
                                        </div>
                                        <span class="text-lowercase text-sm" style="font-family: var(--bs-font-sans-serif);">Konfirmasi penghapusan data akan menyebabkan kehilangan informasi secara permanen dari layanan legal</span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger"><i class="bi bi-x-circle" data-bs-dismiss="modal"></i></button>
                                <a type="/legal/delete/'.$model->id.'" class="btn btn-primary"><i class="bi bi-check2-circle"></i></a>
                            </div>
                            </div>
                        </div>
                        </div>
                        ';
            return $btn;
        })
        ->addColumn('divisions', '{{$model->divisions->name}}')
        ->rawColumns(['action'])
        ->toJson();
    }
}
