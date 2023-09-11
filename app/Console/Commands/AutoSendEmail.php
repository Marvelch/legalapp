<?php

namespace App\Console\Commands;

use App\Mail\SendEmailAgreement;
use App\Mail\SendMail;
use App\Models\Agreement;
use App\Models\Licensing;
use Illuminate\Console\Command;
use Mail;

class AutoSendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:auto-send-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
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

        return 0;
    }
}
