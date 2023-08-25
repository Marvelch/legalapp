<?php

namespace App\Jobs;

use App\Mail\SendMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class SendBulkQueueEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $details;
    public $timeout = 10; // 2 hours

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // $data = User::all();
        // $input['subject'] = $this->details['subject'];

        // foreach ($data as $key => $value) {
        //     $input['email'] = $value->email;
        //     $input['name'] = $value->name;
        //     \Mail::send('emails.test', [], function($message) use($input){
        //         $message->to($input['email'], $input['name'])
        //             ->subject($input['subject']);
        //     });
        // }
        $mailTamplate = [
            'title' => 'Legal Hello'
        ];

        Mail::to('it@sekarbumi.com')->send(new SendMail($mailTamplate));
    }
}
