@extends('layouts.base')

@section('content')
<div class="pc-content">
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{url('/home')}}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{url('/index_agreement')}}">Utama</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Tampil
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- [ Main Content ] start -->
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-body my-5 d-flex justify-content-center">
                    <div class="col-10">
                        <h6>Data Perizinan</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card mt-3">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                <tbody style="font-size: 13px;">
                                                    <tr>
                                                        <td>Nama Perjanjian</td>
                                                        <td>: {{ucfirst(@$agreements->agreement_name)}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Counter Party</td>
                                                        <td>: {{ucfirst(@$agreements->counter_party_name)}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Badan Hukum</td>
                                                        <td>: {{strtoupper($agreements->companys->name)}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Perpanjangan</td>
                                                        <td>: {{ @$agreements->renewal_date}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Keterangan</td>
                                                        <td>: {{ @$agreements->description}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row text-sm">
                                    <div class="col-md-12 mt-3">
                                        <div class="card" style="border-left: 0.2rem solid #54b95b;">
                                            <div class="card-body">
                                                <div class="d-flex bd-highlight">
                                                    <div class="flex-grow-1 bd-highlight"><h6 style="padding-top: 10px; padding-left: 9px;"></h6></div>
                                                    <div class="bd-highlight"><i class="bi bi-calendar-event-fill" style="font-size: 25px; color: #54b95b;"></i></div>
                                                </div>
                                                <div class="table-responsive mt-2">
                                                    <table class="table table-borderless">
                                                        <tbody class="text-muted">
                                                            <tr>
                                                                <td class="col-md-5">
                                                                    Tanggal Tanda Tangan 
                                                                </td>
                                                                <td>
                                                                    : {{date('d F Y',strtotime(@$agreements->signing_date))}} 
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td >
                                                                    Tanggal Berakhir 
                                                                </td>
                                                                <td>
                                                                    : {{date('d F Y',strtotime(@$agreements->effective_date))}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Tanggal Efektif 
                                                                </td>
                                                                <td>
                                                                    : {{date('d F Y',strtotime(@$agreements->end_date))}}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="card" style="border-left: 0.2rem solid #54b95b;">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <button class="btn-ok btn-default w-100">Preview</button>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <a class="btn-ok btn-default w-100" href="{{route('download_agreement',['id'=>Crypt::encryptString($agreements->documents)])}}" style="color: #ffff">Download</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ sample-page ] end -->
    </div>
    <!-- [ Main Content ] end -->
</div>
@endsection
