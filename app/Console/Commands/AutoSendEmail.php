<?php

namespace App\Console\Commands;

use App\Mail\SendEmailAgreement;
use App\Mail\SendMail;
use App\Models\Agreement;
use App\Models\Division;
use App\Models\Licensing;
use Carbon\Carbon;
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

        $ccEmails = ["mr.marvel.christevan@gmail.com"];

        /*------------------------- Set Notification For Licensing -------------------------*/

        ## 60 Days ##
        foreach($items as $item) {
            $sendMail = new SendMail($item);
            Mail::to($item->users->email)->cc($ccEmails)->send($sendMail);
            $DateEnd = Carbon::parse($item->date_end);

            $data = [
                'nama_pengguna' => ucfirst($item->users->name),
                'no_perizinan' => "nomor terlampir : ".$item->permit_number,
                'nama_perizinan' => $item->permit_name,
                'telepon' => $item->users->phone,
                'tanggal' => $DateEnd->format('d F Y')." sebagai pemberitahuan 60 hari sebelum perizinan berakhir",
            ];

            Http::post('http://10.10.30.14:8888/wa/perizinan', $data);
        }

        ## 30 Days ##
        $items30DaysBefore = Licensing::where('set_notification', date('Y-m-d', strtotime('+30 days', strtotime(now()))))->get();

        foreach($items30DaysBefore as $item) {
            $sendMail = new SendMail($item);
            Mail::to($item->users->email)->cc($ccEmails)->send($sendMail);
            $DateEnd = Carbon::parse($item->date_end);

            $data = [
                'nama_pengguna' => ucfirst($item->users->name),
                'no_perizinan' => "nomor terlampir : ".$item->permit_number,
                'nama_perizinan' => $item->permit_name,
                'telepon' => $item->users->phone,
                'tanggal' => $DateEnd->format('d F Y')." sebagai pemberitahuan 30 hari sebelum perizinan berakhir",
            ];

            Http::post('http://10.10.30.14:8888/wa/perizinan', $data);
        }

        ## 15 Days ##
        $items30DaysBefore = Licensing::where('set_notification', date('Y-m-d', strtotime('+15 days', strtotime(now()))))->get();

        foreach($items30DaysBefore as $item) {
            $sendMail = new SendMail($item);
            Mail::to($item->users->email)->cc($ccEmails)->send($sendMail);
            $DateEnd = Carbon::parse($item->date_end);

            $data = [
                'nama_pengguna' => ucfirst($item->users->name),
                'no_perizinan' => "nomor terlampir : ".$item->permit_number,
                'nama_perizinan' => $item->permit_name,
                'telepon' => $item->users->phone,
                'tanggal' => $DateEnd->format('d F Y')." sebagai pemberitahuan 15 hari sebelum perizinan berakhir",
            ];

            Http::post('http://10.10.30.14:8888/wa/perizinan', $data);
        }

        /*------------------------- End Set Notification For Licensing -------------------------*/

        /*------------------------- Set Notification For Agreement -------------------------*/

        ## 60 Days ##
        $items_agg = Agreement::where('set_notification',date('Y-m-d',strtotime(now())))->get();

        foreach($items_agg as $item) {
            $sendMail = new SendEmailAgreement($item);
            Mail::to($item->users->email)->cc($ccEmails)->send($sendMail);
            $DateEnd = Carbon::parse($item->date_end);

            $data = [
                'nama_pengguna' => $item->users->name,
                'no_perizinan' => "nomor terlampir : ".$item->counter_party_name,
                'nama_perizinan' => $item->agreement_name,
                'telepon' => $item->users->phone,
                'tanggal' => $DateEnd->format('d F Y')." sebagai pemberitahuan 60 hari sebelum perjanjian berakhir",
            ];

            Http::post('http://10.10.30.14:8888/wa/perizinan', $data);
        }

        ## 30 Days ##
        $items_agg = Agreement::where('set_notification', date('Y-m-d', strtotime('+30 days', strtotime(now()))))->get();

        foreach($items_agg as $item) {
            $sendMail = new SendEmailAgreement($item);
            Mail::to($item->users->email)->cc($ccEmails)->send($sendMail);
            $DateEnd = Carbon::parse($item->date_end);

            $data = [
                'nama_pengguna' => $item->users->name,
                'no_perizinan' => "nomor terlampir : ".$item->counter_party_name,
                'nama_perizinan' => $item->agreement_name,
                'telepon' => $item->users->phone,
                'tanggal' => $DateEnd->format('d F Y')." sebagai pemberitahuan 30 hari sebelum perjanjian berakhir",
            ];

            Http::post('http://10.10.30.14:8888/wa/perizinan', $data);
        }

        ## 15 Days ##
        $items_agg = Agreement::where('set_notification', date('Y-m-d', strtotime('+15 days', strtotime(now()))))->get();

        foreach($items_agg as $item) {
            $sendMail = new SendEmailAgreement($item);
            Mail::to($item->users->email)->cc($ccEmails)->send($sendMail);
            $DateEnd = Carbon::parse($item->date_end);

            $data = [
                'nama_pengguna' => $item->users->name,
                'no_perizinan' => "nomor terlampir : ".$item->counter_party_name,
                'nama_perizinan' => $item->agreement_name,
                'telepon' => $item->users->phone,
                'tanggal' => $DateEnd->format('d F Y')." sebagai pemberitahuan 15 hari sebelum perjanjian berakhir",
            ];

            Http::post('http://10.10.30.14:8888/wa/perizinan', $data);
        }

        /*------------------------- End Set Notification For Agreement -------------------------*/
    }
}
