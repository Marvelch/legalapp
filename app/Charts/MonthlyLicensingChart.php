<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use DB;

class MonthlyLicensingChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
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

        return $this->chart->pieChart()
            ->setTitle("Laporan Mingguan Perizinan")
            ->setSubtitle('Bulan '.date('F',strtotime($currentMonth)).' '.$currentYear)
            ->addData($weeklyData)
            ->setLabels(['MINGGU 1','MINGGU 2','MINGGU 3','MINGGU 4','MINGGU 5']);
    }
}
