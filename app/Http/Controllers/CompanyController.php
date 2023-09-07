<?php

namespace App\Http\Controllers;

use App\DataTables\CompanyDataTable;
use App\Models\Company;
use App\Models\Division;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use DB;
use Auth;
use Alert;
use App\Models\Agreement;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CompanyDataTable $dataTable)
    {
        return view('pages.company.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items = Division::all();

        return view('pages.company.create',compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|min:2|max:255',
            'address'       => 'required|min:2|max:255',
            'division'      => 'required',
        ]);

        DB::beginTransaction();

        try {
            Company::create([
                'name' => strtolower($request->name),
                'address' => strtolower($request->address),
                'division_id' => $request->division,
                'information' => $request->information
            ]);

            DB::commit();
            Alert::success('SUCCEED','Successfully save data to system');

            return redirect()->route('index_company');
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
    public function show(Company $company, $id)
    {
        $companys = Company::find(Crypt::decryptString($id));

        return view('pages.company.show',compact('companys'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company, $id)
    {
        $company = Company::find(Crypt::decryptString($id));
        $division = Division::all();

        return view('pages.company.edit',compact('company','division'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'          => 'required|min:2|max:255',
            'address'       => 'required|min:2|max:255',
            'division'      => 'required',
        ]);

        DB::beginTransaction();

        try {
            Company::find($id)->update([
                'name' => strtolower($request->name),
                'address' => strtolower($request->address),
                'division_id' => $request->division,
            ]);

            DB::commit();
            Alert::success('SUCCEED','Data update has been successful');

            return redirect()->route('index_company');
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
            $checkAgree = Agreement::where('company_id',$id)->first();

            if($checkAgree) {
                DB::rollback();
                Alert::info('CANT','Deletion not allowed, has been used');

                return back();
            }else{
                Company::find($id)->delete();
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
    public function companyTable()
    {
        $model = Company::query();
            return DataTables::eloquent($model)
            ->addColumn('division','{{$model->divisions->name}}')
            ->addColumn('action',function($model){
            $btn = '<div class="d-flex justify-content-center"><a href="/company/show/'.Crypt::encryptString($model->id).'" class="btn btn-primary btn-sm m-1"><i class="ti ti-eye"></i></a><a href="/company/edit/'.Crypt::encryptString($model->id).'" class="btn btn-success btn-sm m-1" style="color: white"><i class="ti ti-pencil"></i></a><button type="button" class="btn btn-danger btn-sm m-1" data-bs-toggle="modal" data-bs-target="#modalDelete'.$model->id.'"><i class="ti ti-trash"></i></button></div>
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
                                <div class="col-8 text-sm">
                                    <div class="from group mb-3">
                                    <h5 class="mt-2">'.$model->name.'</h5>
                                    </div>
                                    <span style="font-size: 10px;" class="text-lowercase">Penghapusan akan dilakukan secara permanen dari sistem, pastikan penghapusan telah sesuai.</span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary text-sm" data-bs-dismiss="modal" style="border-radius: 50%;"><i class="bi bi-x fa-lg"></i></button>
                            <a href="/company/delete/'.$model->id.'" class="btn btn-primary text-sm text-capitalize" style="border-radius: 50%;"><i class="bi bi-check-lg fa-lg"></i></a>
                        </div>
                        </div>
                    </div>
                    </div>
                    ';
            return $btn;
        })
        ->rawColumns(['action'])
        ->toJson();
    }
}
