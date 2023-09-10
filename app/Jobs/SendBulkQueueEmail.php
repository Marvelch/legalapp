<?php

namespace App\Jobs;

use App\Mail\SendEmailAgreement;
use App\Mail\SendMail;
use App\Models\Agreement;
use App\Models\Licensing;
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
    protected $items_agg;
    public $timeout = 10; // 2 hours

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        // $this->items = $items;
        // $this->items_agg = $items_agg;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        date_default_timezone_set('Asia/Jakarta');

        $items = Licensing::where('set_notification',date('Y-m-d',strtotime(now())))->get();

        $items_agg = Agreement::where('set_notification',date('Y-m-d',strtotime(now())))->get();

        $ccEmails = ["bed@bumipanganutama.com", "mr.marvel.christevan@gmail.com"];

        foreach($items_agg as $item) {
            $sendMail = new SendEmailAgreement($item);
            Mail::to($item->users->email)->cc($ccEmails)->send($sendMail);
        }

        foreach($items as $item) {
            $sendMail = new SendMail($item);
            Mail::to($item->users->email)->cc($ccEmails)->send($sendMail);
        }
    }
}
