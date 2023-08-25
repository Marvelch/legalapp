<?php

namespace App\Http\Controllers;

use App\Jobs\SendBulkQueueEmail;
use App\Models\MailServer;
use Illuminate\Http\Request;
use Mail;
use App\Mail\SendMail;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(MailServer $mailServer)
    {
        //
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
        $job = (new SendBulkQueueEmail())
            ->delay(
            	now()
            	->addSeconds(2)
            ); 

        dispatch($job);

        echo "Bulk mail send successfully in the background...";
    }

    /**
     * Display a listing of the resource.
     */
    public function tamplate()
    {
        return view('pages.mail.tamplate');
    }
}
