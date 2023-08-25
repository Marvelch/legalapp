<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

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
                                        <span class="fw-bold">'.$model->name.'</span>
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
        ->addColumn('password_text','Hardcode')
        ->addColumn('level','Editor')
        ->rawColumns(['action'])
        ->toJson();
    }
}
