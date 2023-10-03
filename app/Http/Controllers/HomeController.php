<?php

namespace App\Http\Controllers;

use App\Charts\MonthlyLicensingChart;
use App\Models\Agreement;
use App\Models\Company;
use App\Models\Licensing;
use App\Models\Publisher;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(MonthlyLicensingChart $chart)
    {
        // return view('home',['chart' => $chart->build()]);
        $licesings = Licensing::where('date_end', '>=', now())
                    ->orderBy('date_end', 'asc')
                    ->take(10)
                    ->get();

        $agreements = Agreement::where('date_end', '>=', now())
                    ->orderBy('date_end', 'asc')
                    ->take(10)
                    ->get();

        return view('home',compact('licesings','agreements'));
    }

    public function testChart() {
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        $weeklyData = [];

        // Menghitung jumlah hari pada bulan ini
        $currentDate = Carbon::now();
        $daysInThisMonth = $currentDate->daysInMonth; // 30

        $startInt = 1;
        $endInt = 7;
        for ($week = 1; $week <= 5; $week++) { // Assuming a maximum of 5 weeks in a month
            $startDate = $currentYear."-".$currentMonth."-".$startInt;
            $endDate = $currentYear."-".$currentMonth."-".$endInt;

            $startInt = $startInt + 7;
            $endInt = $endInt + 7;

            if($endInt > $daysInThisMonth) {
                $endInt = $endInt - ($endInt - $daysInThisMonth);
            }

            $count = DB::table('licensings')
                ->whereYear('date_end', $currentYear)
                ->whereMonth('date_end', $currentMonth)
                ->whereBetween('date_end', [$startDate, $endDate])
                ->count();

            $weeklyData[] = $count;
        }
        return $weeklyData;
    }
}
