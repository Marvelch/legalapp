<?php

namespace App\Jobs;

use App\Mail\SendEmailAgreement;
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
    protected $items_agg;
    public $timeout = 10; // 2 hours

    /**
     * Create a new job instance.
     */
    public function __construct($items, $items_agg)
    {
        $this->items = $items;
        $this->items_agg = $items_agg;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $ccEmails = ["it@bumipanganutama.com", "it@sekarbumi.com"];

        foreach($this->items_agg as $item) {
            $sendMail = new SendEmailAgreement($item);
            Mail::to($item->users->email)->cc($ccEmails)->send($sendMail);
        }

        foreach($this->items as $item) {
            $sendMail = new SendMail($item);
            Mail::to($item->users->email)->cc($ccEmails)->send($sendMail);
        }
    }
}
