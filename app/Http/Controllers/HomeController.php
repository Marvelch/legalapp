<?php

namespace App\Http\Controllers;

use App\Models\Agreement;
use App\Models\Company;
use App\Models\Licensing;
use App\Models\Publisher;
use Illuminate\Http\Request;

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
        $com_counts = Company::count();
        $agg_counts = Agreement::count();
        $lic_counts = Licensing::count();
        $pub_counts = Publisher::count();

        return view('home',compact('com_counts','agg_counts','lic_counts','pub_counts'));
    }
}
