@extends('layouts.base')

@section('content')
<div class="row">
    <!-- [ sample-page ] start -->
    <div class="col-xl-4 col-md-6">
        <div class="card bg-secondary-dark dashnum-card text-white overflow-hidden">
            <span class="round small"></span>
            <span class="round big"></span>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="avtar avtar-lg">
                            <i class="text-white ti bi-filetype-doc"></i>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="btn-group">
                            <a type="button" class="avtar bg-secondary dropdown-toggle arrow-none"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ti ti-dots"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><button class="dropdown-item" type="button">Import Card</button></li>
                                <li><button class="dropdown-item" type="button">Export</button></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <span class="text-white d-block f-34 f-w-500 my-2">13 <i
                        class="ti ti-arrow-up-right-circle opacity-50"></i></span>
                <p class="mb-0 opacity-50">Total Perizinan</p>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6">
        <div class="card bg-primary-dark dashnum-card text-white overflow-hidden">
            <span class="round small"></span>
            <span class="round big"></span>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="avtar avtar-lg">
                            <i class="text-white ti bi-clipboard2-data-fill"></i>
                        </div>
                    </div>
                    <div class="col-auto">
                        <ul class="nav nav-pills justify-content-end mb-0" id="chart-tab-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-white active" id="chart-tab-home-tab" data-bs-toggle="pill"
                                    data-bs-target="#chart-tab-home" type="button" role="tab"
                                    aria-controls="chart-tab-home" aria-selected="true">Bulan</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-white" id="chart-tab-profile-tab" data-bs-toggle="pill"
                                    data-bs-target="#chart-tab-profile" type="button" role="tab"
                                    aria-controls="chart-tab-profile" aria-selected="false">Tahun</button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content" id="chart-tab-tabContent">
                    <div class="tab-pane show active" id="chart-tab-home" role="tabpanel"
                        aria-labelledby="chart-tab-home-tab" tabindex="0">
                        <div class="row">
                            <div class="col-6">
                                <span class="text-white d-block f-34 f-w-500 my-2">300<i
                                        class="ti ti-arrow-up-right-circle opacity-50"></i></span>
                                <p class="mb-0 opacity-50">Total Perjanjian</p>
                            </div>
                            <div class="col-6">
                                <div id="tab-chart-1"></div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="chart-tab-profile" role="tabpanel" aria-labelledby="chart-tab-profile-tab"
                        tabindex="0">
                        <div class="row">
                            <div class="col-6">
                                <span class="text-white d-block f-34 f-w-500 my-2">500 <i
                                        class="ti ti-arrow-down-right-circle opacity-50"></i></span>
                                <p class="mb-0 opacity-50">Total Perjanjian</p>
                            </div>
                            <div class="col-6">
                                <div id="tab-chart-2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-12">
        <div class="card bg-primary-dark dashnum-card dashnum-card-small text-white overflow-hidden">
            <span class="round bg-primary small"></span>
            <span class="round bg-primary big"></span>
            <div class="card-body p-3">
                <div class="d-flex align-items-center">
                    <div class="avtar avtar-lg">
                        <i class="text-white ti bi-house-gear"></i>
                    </div>
                    <div class="ms-2">
                        <h4 class="text-white mb-1">90 <i class="ti ti-arrow-up-right-circle opacity-50"></i></h4>
                        <p class="mb-0 opacity-50 text-sm">Perusahaan</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card dashnum-card dashnum-card-small overflow-hidden">
            <span class="round bg-warning small"></span>
            <span class="round bg-warning big"></span>
            <div class="card-body p-3">
                <div class="d-flex align-items-center">
                    <div class="avtar avtar-lg bg-light-warning">
                        <i class="text-warning ti bi-building-fill-check"></i>
                    </div>
                    <div class="ms-2">
                        <h4 class="mb-1">240 <i class="ti ti-arrow-up-right-circle opacity-50"></i></h4>
                        <p class="mb-0 opacity-50 text-sm">Penerbit</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ sample-page ] end -->
</div>
@endsection
