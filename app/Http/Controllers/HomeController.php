<?php

namespace App\Http\Controllers;

use App\Models\Agreement;
use App\Models\Company;
use App\Models\Licensing;
use App\Models\Publisher;
use Illuminate\Http\Request;
use DB;

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
    public function index()
    {
        /* ---------------------------------------- Licensing ---------------------------------------- */
        $monthlyCounts = [];

        // Loop through the months from January (1) to December (12)
        for ($month = 1; $month <= 12; $month++) {
            // Calculate the count for the current month
            $count = Licensing::whereMonth('created_at', $month)->count();

            // Add the count to the array with the month as the key
            $monthlyCounts[$month] = $count;
        }

        $monthlyNewArray = [];
        foreach($monthlyCounts as $item) {
            array_push($monthlyNewArray, $item);
        }

        /* ---------------------------------------- Agreement ---------------------------------------- */
        $monthlyAgCounts = [];

        // Loop through the months from January (1) to December (12)
        for ($month = 1; $month <= 12; $month++) {
            // Calculate the count for the current month
            $count = Agreement::whereMonth('created_at', $month)->count();

            // Add the count to the array with the month as the key
            $monthlyAgCounts[$month] = $count;
        }

        $monthlyAgNewArray = [];
        foreach($monthlyAgCounts as $item) {
            array_push($monthlyNewArray, $item);
        }

        $publishers = Publisher::count();
        $companys = Company::count();

    return view('home',compact('monthlyNewArray','monthlyAgNewArray','publishers','companys'));
    }
}
