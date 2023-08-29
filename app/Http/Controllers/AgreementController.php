<?php

namespace App\Http\Controllers;

use App\Models\Agreement;
use Illuminate\Http\Request;
use DB;
use Alert;
use App\Models\Company;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class AgreementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.agreement.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.agreement.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'agreement_name' => 'required|min:2|max:255',
            'counter_party_name' => 'required|min:2|max:255',
            'company' => 'required',
            'signing_date' => 'required',
            'effective_date' => 'required',
        ]);

        DB::beginTransaction();

        try {

             if($request->renewal_date) {
                $days = $request->renewal_date * 2;
                $extraTime = date('Y-m-d', strtotime(-$days.'days', strtotime($request->end_date)));
            }

            if(@$request->file('documents')) {
                $documents = $request->file('documents')->store('Agreements');
            }

            Agreement::create([
                'agreement_name' => $request->agreement_name,
                'company_id' => $request->company,
                'counter_party_name' => $request->counter_party_name,
                'signing_date' => $request->signing_date,
                'effective_date' => $request->effective_date,
                'end_date' => $request->end_date,
                'renewal_date' => $request->renewal_date,
                'date_notification' => @$extraTime,
                'documents' => @$documents,
                'description' => $request->description,
                'user_id' => Auth::user()->id
            ]);

            DB::commit();

            Alert::success('SUCCEED','Successfully save data to system');
            return redirect()->route('index_agreement');
        } catch (\Throwable $th) {
            //throw $th;

            DB::rollback();

            // Alert::error('FAIL','Failed to save because we ran into a problem');
            // return back();

            return $th->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Agreement $agreement,$id)
    {
        $agreements = Agreement::find(Crypt::decryptString($id));

        return view('pages.agreement.show',compact('agreements'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agreement $agreement, $id)
    {
        $agreements = Agreement::find(Crypt::decryptString($id));

        return view('pages.agreement.edit',compact('agreements'));
    }

    /**
     * Display a listing of the resource.
     */
    public function searchingCompany(Request $request)
    {
        $data = [];

        $data = Company::select("name", "id")
                        ->where('name', 'LIKE', '%'. $request->get('q'). '%')
                        ->get();

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'agreement_name' => 'required|min:2|max:255',
            'counter_party_name' => 'required|min:2|max:255',
            'company' => 'required',
            'signing_date' => 'required',
            'effective_date' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $agreements = Agreement::find($id)->first();

            if($request->renewal_date) {
                $days = $request->renewal_date * 2;
                $extraTime = date('Y-m-d', strtotime(-$days.'days', strtotime($request->end_date)));
            }

            if(@$request->file('documents')) {
                Storage::delete($agreements->documents);
                $documents = $request->file('documents')->store('Agreements');
            }else{
                $agreement = Agreement::find($id);
                $documents = $agreement->documents;
            }

            Agreement::find($id)->update([
                'agreement_name' => $request->agreement_name,
                'company_id' => $request->company,
                'counter_party_name' => $request->counter_party_name,
                'signing_date' => $request->signing_date,
                'effective_date' => $request->effective_date,
                'end_date' => $request->end_date,
                'renewal_date' => $request->renewal_date,
                'date_notification' => @$extraTime,
                'documents' => @$documents,
                'description' => $request->description
            ]);

            DB::commit();

            Alert::success('SUCCEED','Successfully save data to system');
            return redirect()->route('index_agreement');
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
    public function destroy(Agreement $agreement,$id)
    {
        DB::beginTransaction();

        try {
            $agreements = Agreement::find($id)->first();

            Storage::delete($agreements->documents);

            Agreement::find($id)->delete();
            
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
    public function agreementTable()
    {
        $model = Agreement::query();
            return DataTables::eloquent($model)
            ->addColumn('action',function($model){
            $btn = '<div class="d-flex justify-content-center"><a href="/agreement/show/'.Crypt::encryptString($model->id).'" class="btn btn-primary btn-sm m-1"><i class="ti ti-eye"></i></a><button type="button" class="btn btn-danger btn-sm m-1" data-bs-toggle="modal" data-bs-target="#modalDelete'.$model->id.'"><i class="ti ti-trash"></i></button><a href="/agreement/edit/'.Crypt::encryptString($model->id).'" class="btn btn-success btn-sm m-1" style="color: white"><i class="ti ti-pencil"></i></a></div>
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
                                        <span class="fw-bold">'.$model->agreement_name.'</span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary text-sm" data-bs-dismiss="modal">Batal</button>
                                <a href="/agreement/delete/'.$model->id.'" class="btn btn-danger text-sm">Hapus</a>
                            </div>
                            </div>
                        </div>
                        </div>
                        ';
            return $btn;
        })
        ->editColumn('end_date', function($model){
            $formatDate = date('d-m-Y',strtotime($model->end_date));
            return $formatDate;
        })
        ->addColumn('company','{{$model->companys->name}}')
        ->rawColumns(['action'])
        ->toJson();
    }

    /**
     * Download file
     */
    public function download($id) 
    {
        return Storage::download(Crypt::decryptString($id));
    }
}