<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\LegalEntity;
use App\Models\Licensing;
use App\Models\Publisher;
use Illuminate\Http\Request;
use DB;
use Auth;
use Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;

class LicensingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.licensing.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('pages.licensing.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'permit_number' => 'required|min:2|max:255',
            'permit_name'   => 'required|min:2|max:255',
            'date_start'    => 'required',
            'date_end'      => 'required',
            'description'   => 'max: 500'
        ]);

        DB::beginTransaction();

        try {
            // if($request->period) {
            //     $days = $request->period * 2;
            //     $extraTime = date('Y-m-d', strtotime(-$days.'days', strtotime($request->date_end)));
            // }
            // dd($request->document);

            foreach($request->document as $item) {
                dd($request->document);
            }

            // if(@$request->file('documents')) {
                // $documents = $request->file('documents')->store('Licensing');
            // }

            // Licensing::create([
            //     'legal_entity_id' => $request->legal_entity,
            //     'permit_number' => strtolower($request->permit_number),
            //     'permit_name' => strtolower($request->permit_name),
            //     'publisher_id' => $request->publisher,
            //     'date_start' => $request->date_start,
            //     'date_end' => $request->date_end,
            //     'period' => $request->period,
            //     'extra_time' => @$extraTime,
            //     'documents' => @$documents,
            //     'description' => strtolower($request->description),
            //     'user_id' => Auth::user()->id
            // ]);

            // DB::commit();
            // Alert::success('SUCCEED','Successfully save data to system');

            // return back();
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
    public function show(Licensing $licensing, $id)
    {
        $licensings = Licensing::find(Crypt::decryptString($id));

        return view('pages.licensing.show',compact('licensings'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Licensing $licensing, $id)
    {
        $licensings = Licensing::find(Crypt::decryptString($id));

        return view('pages.licensing.edit',compact('licensings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'permit_number' => 'required|min:2|max:255',
            'permit_name'   => 'required|min:2|max:255',
            'date_start'    => 'required',
            'date_end'      => 'required',
            'description'   => 'max: 500'
        ]);

        DB::beginTransaction();

        try {

            if($request->period) {
                $days = $request->period * 2;
                $extraTime = date('Y-m-d', strtotime(-$days.'days', strtotime($request->date_end)));
            }

            if(@$request->file('documents')) {
                $documents = $request->file('documents')->store('Licensing');
            }else{
                $licensing = Licensing::find($id);
                $documents = $licensing->documents;
            }

            Licensing::find($id)->update([
                'legal_entity_id' => $request->legal_entity,
                'permit_number' => strtolower($request->permit_number),
                'permit_name' => strtolower($request->permit_name),
                'publisher_id' => $request->publisher,
                'date_start' => $request->date_start,
                'date_end' => $request->date_end,
                'period' => $request->period,
                'extra_time' => @$extraTime,
                'documents' => @$documents,
                'description' => strtolower($request->description)
            ]);

            DB::commit();
            Alert::success('SUCCEED','Successfully save data to system');

            return back();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();

            // Alert::error('FAIL','Failed to save because we ran into a problem');
            // return back();

            return $th->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Licensing $licensing, $id)
    {
        DB::beginTransaction();

        try {
            Licensing::find($id)->delete();
            
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
    public function Searching(Request $request)
    {
        $data = [];

        $data = LegalEntity::select("name", "id")
                        ->where('name', 'LIKE', '%'. $request->get('q'). '%')
                        ->get();

        return response()->json($data);
    }

    /**
     * Company data search for autocomplate.
     */
    public function SearchingCompany(Request $request)
    {
        $data = [];

        $data = Company::select("name", "id")
                        ->where('name', 'LIKE', '%'. $request->get('q'). '%')
                        ->get();

        return response()->json($data);
    }

    /**
     * Display a listing of the resource.
     */
    public function SearchingPublisher(Request $request)
    {
        $data = [];

        $data = Publisher::select("name", "id")
                        ->where('name', 'LIKE', '%'. $request->get('q'). '%')
                        ->get();

        return response()->json($data);
    }

    /**
     * Display a listing of the resource.
     */
    public function licensingTable()
    {
        $model = Licensing::query();
            return DataTables::eloquent($model)
            ->addColumn('action',function($model){
            $btn = '<div class="d-flex justify-content-center"><a href="/licensing/show/'.Crypt::encryptString($model->id).'" class="btn btn-primary btn-sm m-1"><i class="ti ti-eye"></i></a><a href="/licensing/edit/'.Crypt::encryptString($model->id).'" class="btn btn-success btn-sm m-1" style="color: white"><i class="ti ti-pencil"></i></a><button type="button" class="btn btn-danger btn-sm m-1" data-bs-toggle="modal" data-bs-target="#modalDelete'.$model->id.'"><i class="ti ti-trash"></i></button></div>
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
                                        <span class="fw-bold">'.$model->permit_number.'</span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary text-sm" data-bs-dismiss="modal">Batal</button>
                                <a href="/licensing/delete/'.$model->id.'" class="btn btn-danger text-sm">Hapus</a>
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

    /**
     * Display a listing of the resource.
     */
    public function download($id) 
    {
        return Storage::download(Crypt::decryptString($id));
    }
}
