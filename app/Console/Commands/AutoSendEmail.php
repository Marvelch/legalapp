<?php

namespace App\Console\Commands;

use App\Mail\SendEmailAgreement;
use App\Mail\SendMail;
use App\Models\Agreement;
use App\Models\Division;
use App\Models\Licensing;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail as FacadesMail;
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

            $data = [
                'nama_pengguna' => $item->users->name,
                'no_perizinan' => $item->counter_party_name,
                'nama_perizinan' => $item->agreement_name,
                'telepon' => $item->users->phone,
                'tanggal' => $item->date_end,
            ];

            Http::post('http://10.10.30.14:8888/wa/perizinan', $data);
        }

        foreach($items as $item) {
            $sendMail = new SendMail($item);
            Mail::to($item->users->email)->cc($ccEmails)->send($sendMail);

            $data = [
                'nama_pengguna' => $item->users->name,
                'no_perizinan' => $item->permit_number,
                'nama_perizinan' => $item->permit_name,
                'telepon' => $item->users->phone,
                'tanggal' => $item->date_end,
            ];

            Http::post('http://10.10.30.14:8888/wa/perizinan', $data);
        }
    }
}
