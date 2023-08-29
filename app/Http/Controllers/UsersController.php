<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use DB;
use Alert;

class UsersController extends Controller
{
    public function index()
    {
        return view('pages.user.index');
    }

     /**
     * Display a listing of the resource.
     */
    public function userTable()
    {
        $model = User::query();
            return DataTables::eloquent($model)
            ->addColumn('action',function($model){
            $btn = '<div class="d-flex justify-content-center"><button type="button" class="btn btn-danger btn-sm m-1" data-bs-toggle="modal" data-bs-target="#modalDelete'.$model->id.'"><i class="ti ti-trash"></i></button><a href="/user/edit/'.Crypt::encryptString($model->id).'" class="btn btn-success btn-sm m-1" style="color: white"><i class="ti ti-pencil"></i></a></div>
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
                                <a href="/user/delete/'.$model->id.'" class="btn btn-danger text-sm">Hapus</a>
                            </div>
                            </div>
                        </div>
                        </div>
                        ';
            return $btn;
        })
        ->addColumn('level',function($model) {
            return $model->type;
        })
        ->rawColumns(['action'])
        ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|min:2|max:255',
            'email'         => 'required|email|unique:users|min:2|max:60',
            'password'      => 'required|min:2|max:255',
            'level'         => 'required',
        ]);

        DB::beginTransaction();

        try {
            User::create([
                'name' => strtolower($request->name),
                'email' => strtolower($request->email),
                'password' => Hash::make($request->password),
                'password_text' => $request->password,
                'level' => $request->level
            ]);

            DB::commit();
            Alert::success('SUCCEED','Successfully save data to system');

            return redirect()->route('index_user');
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
            $admin = User::find($id);

            if($admin->type == 'admin') {
                $admin = User::where('type',2)->where('deleted_at',NULL)->get();
                if(count($admin) > 1) {
                    User::find($id)->delete();
                }else{
                    DB::rollback();
                    Alert::info('INFO','Cant delete because web must have admin');
                    return back();
                }
            }else{
                User::find($id)->delete();
            }
            
            DB::commit();
            Alert::success('SUCCEED','Data deletion has been successful');

            return back();
        } catch (\Throwable $th) {
             DB::rollback();

            // Alert::error('FAIL','Failed to delete data, please check again');
            // return back();

            return $th->getMessage();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $users = User::find(Crypt::decryptString($id));

        return view('pages.user.edit',compact('users'));
    }

    /**
     * Update information from user resource
     */
    public function update(Request $request, $id) 
    {
        $request->validate([
            'name'      => 'required|min:2|max:255',
            'email'     => 'required|email',
            'password'  => 'required|min:2|max:255',
            'type'     => 'required'
        ]);

        DB::beginTransaction();

        try {
            User::find($id)->update([
                'name'          => $request->name,
                'email'         => $request->email,
                'password_text' => $request->password,
                'password'      => Hash::make($request->password),
                'type'          => $request->type 
            ]);

            DB::commit();
            Alert::success('SUCCEED','Successfully save data to system');

            return back();
        } catch (\Throwable $th) {
            //throw $th;

            DB::rollback();

            return $th->getMessage();
        }
    }
}
