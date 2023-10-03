<?php

namespace App\Http\Controllers;

use App\Models\Agreement;
use Illuminate\Http\Request;
use DB;
use Alert;
use App\Models\Company;
use App\Models\document;
use App\Models\documentAgreement;
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

        $unique = generateUniqueCode();

        DB::beginTransaction();

        try {

            if($request->check_date_period AND $request->period AND $request->date_end) {
                $days = $request->period * 2;
                $extraTime = date('Y-m-d', strtotime(-$days.'days', strtotime($request->date_end)));
            }

            Agreement::create([
                'agreement_name' => $request->agreement_name,
                'company_id' => $request->company,
                'counter_party_name' => $request->counter_party_name,
                'signing_date' => $request->signing_date,
                'effective_date' => $request->effective_date,
                'date_end' => $request->check_date_period && $request->period ? $request->date_end : null,
                'check_date_period' => $request->check_date_period && $request->period ? 1 : 0,
                'period' => $request->check_date_period && $request->period ? $request->period : null,
                'add_date' => $request->check_date_period && $request->date_end && $request->period ? $extraTime : null,
                'set_notification' => $request->check_date_period && $request->date_end && $request->period ? @$extraTime : null,
                'description' => strtolower($request->description),
                'user_id' => Auth::user()->id,
                'document_keys' => $unique
            ]);

            if($request->documents) {
                foreach($request->documents as $key => $item) {
                    if(@$item) {
                        $documents = $item->store('Agreement');
                    }

                    documentAgreement::create([
                        'file_name' => $item->getClientOriginalName(),
                        'key' => $unique,
                        'path' => @$documents,
                    ]);
                }
            }

            DB::commit();

            Alert::success('SUCCEED','Successfully save data to system');
            return redirect()->route('index_agreement');
        } catch (\Throwable $th) {
            //throw $th;

            DB::rollback();

            // Alert::error('FAIL','Failed to save because we ran into a problem');
            // return back();

            return $th;
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
            $key = Agreement::select('document_keys')->find($id);

            if($request->check_date_period AND $request->period AND $request->date_end) {
                $days = $request->period * 2;
                $extraTime = date('Y-m-d', strtotime(-$days.'days', strtotime($request->date_end)));
            }

            $parent = Agreement::find($id);

            $parent->update([
                'agreement_name' => $request->agreement_name,
                'company_id' => $request->company,
                'counter_party_name' => $request->counter_party_name,
                'signing_date' => $request->signing_date,
                'effective_date' => $request->effective_date,
                'check_date_period' => $request->check_date_period && $request->period ? 1 : 0,
                'date_end' => $request->check_date_period && $request->period ? $request->date_end : null,
                'period' => $request->check_date_period && $request->period ? $request->period : null,
                'add_date' => $request->check_date_period && $request->date_end && $request->period ? $extraTime : null,
                'set_notification' => $request->check_date_period && $request->date_end && $request->period ? @$extraTime : null,
                'description' => strtolower($request->description)
            ]);

            if($request->documents) {
                foreach($request->documents as $key => $item) {
                    if(@$item) {
                        $documents = $item->store('Licensing');
                    }

                    $parent->documentAgreements()->create([
                        'file_name' => $item->getClientOriginalName(),
                        'key' => $key,
                        'path' => @$documents,
                    ]);
                }
            }

            DB::commit();

            Alert::success('SUCCEED','Successfully save data to system');
            return redirect()->route('index_agreement');
        } catch (\Throwable $th) {
            //throw $th;

            DB::rollback();

            // Alert::error('FAIL','Failed to save because we ran into a problem');
            // return back();

            return $th;
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

            $documentAgreement = documentAgreement::where('key',$agreements->document_keys)->get();

            foreach($documentAgreement as $key => $item) {
                if (Storage::exists($item->path)) {
                    Storage::delete($item->path);
                    documentAgreement::find($item->id)->delete();
                }
            }

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
        ->editColumn('date_end', function($model){
            $formatDate = date('d-m-Y',strtotime($model->date_end));
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
