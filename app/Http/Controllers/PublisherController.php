<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;
use DB;
use Alert;
use Yajra\DataTables\Facades\DataTables;
use App\DataTables\PublisherDataTable;
use App\Models\Licensing;
use Illuminate\Support\Facades\Crypt;

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

            return redirect()->route('index_publisher');
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
        $items = Publisher::find(Crypt::decryptString($id));

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
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $checkLegal = Licensing::select('publisher_id')->where('publisher_id',$id)->first();

            if($checkLegal) {
                DB::rollback();
                Alert::info('CANT','Deletion not allowed, has been used');

                return back();
            }else{
                Publisher::find($id)->delete();
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
    public function publisherTable()
    {
        $model = Publisher::query();
            return DataTables::eloquent($model)
            ->addColumn('action',function($model){
            $btn = '<div class="d-flex justify-content-center"><button type="button" class="btn btn-danger btn-sm m-1" data-bs-toggle="modal" data-bs-target="#modalDelete'.$model->id.'"><i class="ti ti-trash"></i></button><a href="/publisher/edit/'.Crypt::encryptString($model->id).'" class="btn btn-success btn-sm m-1" style="color: white"><i class="ti ti-pencil"></i></a></div>
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
                                <button type="button" class="btn btn-danger btn-xs btn-round" data-bs-dismiss="modal"><i class="bi bi-x" style="margin-left: -5px;"></i></button>
                                <a href="/publisher/delete/'.$model->id.'" class="btn btn-primary btn-xs btn-round"><i class="bi bi-check" style="margin-left: -5px;"></i></a>
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
