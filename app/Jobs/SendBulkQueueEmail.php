<?php

namespace App\Jobs;

use App\Mail\SendMail;
use App\Models\Agreement;
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
    protected $items;
    public $timeout = 10; // 2 hours

    /**
     * Create a new job instance.
     */
    public function __construct($items)
    {
        $this->items = $items;
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
        // $mailTamplate = [
        //     'title' => 'Legal Hello'
        // ];

        // Mail::to('Mr.marvel.christevan@gmail.com')->send(new SendMail($mailTamplate));

        // $emails = Agreement

        foreach($this->items as $item) {
            $sendMail = new SendMail($item);
            Mail::to($item->users->email)->send($sendMail);
        }
    }
}
