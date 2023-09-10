<?php

namespace App\Http\Controllers;

use App\Jobs\SendBulkQueueEmail;
use App\Models\MailServer;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Mail;
use DB;
use Alert;
use Yajra\DataTables\Facades\DataTables;
use App\Mail\SendMail;
use App\Models\Agreement;
use App\Models\Licensing;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use PharIo\Manifest\License;

class MailServerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.mail.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.mail.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'mail_server'   => 'required|unique:mail_servers|min:2|max:255',
            'port'          => 'required|min:2|max:255',
            'smtp'          => 'required|min:2|max:255',
            'username'      => 'required|min:2|max:255',
            'password'      => 'required|min:2|max:255',
            'description'   => 'max:500',
        ]);

        DB::beginTransaction();

        try {
            MailServer::create([
                'mail_server' => strtolower($request->mail_server),
                'port' => $request->port,
                'smtp' => $request->smtp,
                'username' => $request->username,
                'password' => $request->password,
                'description' => $request->description,
                'description' => strtolower($request->description)
            ]);

            DB::commit();
            Alert::success('SUCCEED','Successfully save data to system');

            return redirect()->route('index_mail');
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
    public function show(MailServer $mailServer, $id)
    {
        $mail = MailServer::find(Crypt::decryptString($id));

        return view('pages.mail.show',compact('mail'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MailServer $mailServer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MailServer $mailServer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MailServer $mailServer)
    {
        //
    }

    /**
     * Send Email From Legal System.
     */
    public function sendMail(MailServer $mailServer)
    {
        // date_default_timezone_set('Asia/Jakarta');

        // Blast Email

        // $items = Licensing::where('set_notification',date('Y-m-d',strtotime(now())))->get();

        // $items_agg = Agreement::where('set_notification',date('Y-m-d',strtotime(now())))->get();

        // $job = (new SendBulkQueueEmail($items,$items_agg))
        //     ->delay(
        //     	now()
        //     	->addSeconds(2)
        //     );

        // dispatch($job);

        // Blast Whatsapp

        // foreach($items as $item) {
        //     $body = [
        //         'nama_pengguna' => $item->users->name,
        //         'no_perizinan' => $item->permit_number,
        //         'nama_perizinan' => $item->permit_name,
        //         'tanggal' => $item->add_date,
        //     ];

        //     $json = json_encode($body);

        //     $response = Http::get('http://10.10.30.14:8888/wa/perizinan', $json);
        //     echo $response;
        // }

        // foreach($items_agg as $item) {

        //     Http::accept('application/json')->get('http://10.10.30.14:8888/wa/perizinan', [
        //         'nama_pengguna' => $item->users->name,
        //         'no_perizinan' => $item->counter_party_name,
        //         'nama_perizinan' => $item->agreement_name,
        //         'telepon' => '6282217797018',
        //         'tanggal' => $item->add_date,
        //     ]);
        // }

        // foreach($items as $item) {
        //     $body = [
        //         'nama_pengguna' => $item->users->name,
        //         'no_perizinan' => $item->permit_number,
        //         'nama_perizinan' => $item->permit_name,
        //         'tanggal' => $item->add_date,
        //     ];

        //     $json = json_encode($body);

        //     $response = Http::get('http://10.10.30.14:8888/wa/perizinan', $json);
        //     echo $response;
        // }

        // foreach($items_agg as $item) {

        //     Http::accept('application/json')->get('http://10.10.30.14:8888/wa/perizinan', [
        //         'nama_pengguna' => $item->users->name,
        //         'no_perizinan' => $item->counter_party_name,
        //         'nama_perizinan' => $item->agreement_name,
        //         'telepon' => '6282217797018',
        //         'tanggal' => $item->add_date,
        //     ]);
        // }

        // echo "Bulk mail send successfully in the background...";
    }

    /**
     * Display a listing of the resource.
     */
    public function tamplate()
    {
        return view('pages.mail.tamplate');
    }

    /**
     * Display a listing of the resource.
     */
    public function mailTable()
    {
        $model = MailServer::query();
            return DataTables::eloquent($model)
            ->addColumn('action',function($model){
            $btn = '<div class="d-flex justify-content-center"><a href="/mail/show/'.Crypt::encryptString($model->id).'" class="btn btn-primary btn-sm m-1"><i class="ti ti-eye"></i></a><a href="/mail/edit/'.Crypt::encryptString($model->id).'" class="btn btn-success btn-sm m-1" style="color: white"><i class="ti ti-pencil"></i></a><button type="button" class="btn btn-danger btn-sm m-1" data-bs-toggle="modal" data-bs-target="#modalDelete'.$model->id.'"><i class="ti ti-trash"></i></button></div>
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
                                        <h5 class="mt-2 text-uppercase">'.$model->mail_server.'</h5>
                                        </div>
                                        <span style="font-size: 10px;">Proses penghapusan data akan dilakukan secara permanen dari layanan legal, yakin ingin menghapus ?</span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary text-sm" data-bs-dismiss="modal" style="border-radius: 50%;"><i class="bi bi-x fa-lg"></i></button>
                                <a href="/mail/delete/'.$model->id.'" class="btn btn-primary text-sm text-capitalize" style="border-radius: 50%;"><i class="bi bi-check-lg fa-lg"></i></a>
                            </div>
                            </div>
                        </di>
                        </div>
                        ';
            return $btn;
        })
        ->addColumn('defaultChange',function($model) {
            $checkBox = '<div class="d-flex justify-content-center"><div class="form-check form-switch"><input class="form-check-input"
            '.($model->default != NULL ? 'checked' : '').'
            type="checkbox" style="width: 30px; height: 15px" role="switch" id="checkBox'.$model->id.'"></div></div>
            <script>
                $("#checkBox'.$model->id.'").on("change",function(){

                    $.ajax({
                        type: "GET",
                        url: "/mail/update-mail-default/'.$model->id.'",
                        data: {
                            _token: "{{ csrf_token() }}",
                            checked: true
                        },
                        success: function(response, status, xhr) {
                            // Check status code
                            if (xhr.status === 200) {
                                // Status code is 200, redirect
                                window.location.href = response.redirect_url; // Adjust property name as needed
                            } else {
                                // Handle other status codes or errors
                                console.log("Unexpected status code: " + xhr.status);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                });
             </script>';
            return $checkBox;
        })
        ->rawColumns(['action','defaultChange'])
        ->toJson();
    }

    /**
     * Display a listing of the resource.
     */
    public function updateMailDefault(Request $request, $id)
    {
        if ($request->has('checked')) {
            MailServer::query()->update([
                'default' => NULL
            ]);

            MailServer::find($id)->update([
                'default' => 1,
            ]);

            return response()->json(['redirect_url' => '/mail'], 200);
        } else {
            // Checkbox is not checked
            return response()->json(['message' => 'Checkbox is not checked.']);
        }
    }
}
