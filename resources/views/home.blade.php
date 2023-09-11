@extends('layouts.base')

@section('content')
<div class="row">
    <!-- [ sample-page ] start -->
    <div class="col-xl-8 col-md-12">
        <div class="card">
            <div class="card-body">
                <div id="growthchart"></div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3 align-items-center">
                    <div class="col">
                        <h4>Popular Stocks</h4>
                    </div>
                    <div class="col-auto"> </div>
                </div>
                <div class="rounded bg-light-secondary overflow-hidden mb-3">
                    <div class="px-3 pt-3">
                        <div class="row mb-1 align-items-start">
                            <div class="col">
                                <h5 class="text-secondary mb-0">Bajaj Finery</h5>
                                <small class="text-muted">10% Profit</small>
                            </div>
                            <div class="col-auto">
                                <h4 class="mb-0">$1839.00</h4>
                            </div>
                        </div>
                    </div>
                    <div id="bajajchart"></div>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item px-0">
                        <div class="row align-items-start">
                            <div class="col">
                                <h5 class="mb-0">Bajaj Finery</h5>
                                <small class="text-success">10% Profit</small>
                            </div>
                            <div class="col-auto">
                                <h4 class="mb-0">$1839.00<span
                                        class="ms-2 align-top avtar avtar-xxs bg-light-success"><i
                                            class="ti ti-chevron-up text-success"></i></span></h4>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item px-0">
                        <div class="row align-items-start">
                            <div class="col">
                                <h5 class="mb-0">TTML</h5>
                                <small class="text-danger">10% Profit</small>
                            </div>
                            <div class="col-auto">
                                <h4 class="mb-0">$100.00<span class="ms-2 align-top avtar avtar-xxs bg-light-danger"><i
                                            class="ti ti-chevron-down text-danger"></i></span></h4>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item px-0">
                        <div class="row align-items-start">
                            <div class="col">
                                <h5 class="mb-0">Reliance</h5>
                                <small class="text-success">10% Profit</small>
                            </div>
                            <div class="col-auto">
                                <h4 class="mb-0">$200.00<span class="ms-2 align-top avtar avtar-xxs bg-light-success"><i
                                            class="ti ti-chevron-up text-success"></i></span></h4>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item px-0">
                        <div class="row align-items-start">
                            <div class="col">
                                <h5 class="mb-0">TTML</h5>
                                <small class="text-danger">10% Profit</small>
                            </div>
                            <div class="col-auto">
                                <h4 class="mb-0">$189.00<span class="ms-2 align-top avtar avtar-xxs bg-light-danger"><i
                                            class="ti ti-chevron-down text-danger"></i></span></h4>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item px-0">
                        <div class="row align-items-start">
                            <div class="col">
                                <h5 class="mb-0">Stolon</h5>
                                <small class="text-danger">10% Profit</small>
                            </div>
                            <div class="col-auto">
                                <h4 class="mb-0">$189.00<span class="ms-2 align-top avtar avtar-xxs bg-light-danger"><i
                                            class="ti ti-chevron-down text-danger"></i></span></h4>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="text-center">
                    <a href="#!" class="b-b-primary text-primary">View all <i class="ti ti-chevron-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- [ sample-page ] end -->
</div>
<script>
    "use strict";
document.addEventListener("DOMContentLoaded", function () {
    setTimeout(function () {
        floatchart();
    }, 500);
});
function floatchart() {
    (function () {
        var options = {
            chart: { type: "line", height: 90, sparkline: { enabled: true } },
            dataLabels: { enabled: false },
            colors: ["#FFF"],
            stroke: { curve: "smooth", width: 3 },
            series: [
                { name: "series1", data: [45, 66, 41, 89, 25, 44, 9, 54] },
            ],
            yaxis: { min: 5, max: 95 },
            tooltip: {
                theme: "dark",
                fixed: { enabled: false },
                x: { show: false },
                y: {
                    title: {
                        formatter: function (seriesName) {
                            return "Total Earning";
                        },
                    },
                },
                marker: { show: false },
            },
        };
        var chart = new ApexCharts(
            document.querySelector("#tab-chart-1"),
            options
        );
        chart.render();
    })();
    (function () {
        var options = {
            chart: { type: "line", height: 90, sparkline: { enabled: true } },
            dataLabels: { enabled: false },
            colors: ["#FFF"],
            stroke: { curve: "smooth", width: 3 },
            series: [
                { name: "series1", data: [35, 44, 9, 54, 45, 66, 41, 69] },
            ],
            yaxis: { min: 5, max: 95 },
            tooltip: {
                theme: "dark",
                fixed: { enabled: false },
                x: { show: false },
                y: {
                    title: {
                        formatter: function (seriesName) {
                            return "Total Earning";
                        },
                    },
                },
                marker: { show: false },
            },
        };
        var chart = new ApexCharts(
            document.querySelector("#tab-chart-2"),
            options
        );
        chart.render();
    })();
    (function () {
        var options = {
            chart: {
                type: "bar",
                height: 480,
                stacked: true,
                toolbar: { show: false },
            },
            plotOptions: { bar: { horizontal: false, columnWidth: "50%" } },
            dataLabels: { enabled: false },
            colors: ["#2196f3", "#673ab7", "#e1d8f1", "#d3eafd"],
            series: [
                {
                    name: "Perjanjian",
                    data: [35, 125, 35, 35, 35, 80, 35, 20, 35, 45, 15, 75],
                },
                {
                    name: "Perizinan",
                    data: [35, 15, 15, 35, 65, 40, 80, 25, 15, 85, 25, 75],
                },
                // {
                //     name: "Profit",
                //     data: [35, 145, 35, 35, 20, 105, 100, 10, 65, 45, 30, 10],
                // },
                // {
                //     name: "Maintenance",
                //     data: [0, 0, 75, 0, 0, 115, 0, 0, 0, 0, 150, 0],
                // },
            ],
            responsive: [
                {
                    breakpoint: 480,
                    options: {
                        legend: {
                            position: "bottom",
                            offsetX: -10,
                            offsetY: 0,
                        },
                    },
                },
            ],
            xaxis: {
                type: "category",
                categories: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dec",
                ],
            },
            grid: { strokeDashArray: 4 },
            tooltip: { theme: "dark" },
        };
        var chart = new ApexCharts(
            document.querySelector("#growthchart"),
            options
        );
        chart.render();
    })();
    (function () {
        var options = {
            chart: {
                type: "area",
                height: 95,
                stacked: true,
                sparkline: { enabled: true },
            },
            colors: ["#673ab7"],
            stroke: { curve: "smooth", width: 1 },
            series: [{ data: [0, 15, 10, 50, 30, 40, 25] }],
        };
        var chart = new ApexCharts(
            document.querySelector("#bajajchart"),
            options
        );
        chart.render();
    })();
}

</script>
@endsection
