@extends('layouts.base')

@section('content')
<div class="pc-content">
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Penerbit</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{url('/home')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Show
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
            <div class="card" style="background-image: url('https://cdn.wallpapersafari.com/4/53/lGdYRW.jpg');">
                <div class="card-body my-5 d-flex justify-content-center">
                    <div class="col-10 mt-4">
                        <div class="card">
                            <div class="card-body m-4">
                               <div class="table-responsive m-2">
                                 <table class="table table-borderless" id="legalentity-table">
                                    <tbody class="text-capitalize" style="font-size: 13px;">
                                        <tr>
                                            <td>Nama Perjanjian</td>
                                            <td>: {{strtoupper(@$agreements->agreement_name)}}</td>
                                        </tr>
                                        <tr>
                                            <td>Nama Counter Party</td>
                                            <td>: {{ucfirst(@$agreements->counter_party_name)}}</td>
                                        </tr>
                                        <tr>
                                            <td>Badan Hukum</td>
                                            <td>: {{strtoupper($agreements->companys->name)}}</td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Penandatangan</td>
                                            <td>: {{date('d-m-Y',strtotime(@$agreements->signing_date))}}</td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Efektif Berlaku</td>
                                            <td>: {{date('d-m-Y',strtotime(@$agreements->effective_date))}}</td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Berakhir</td>
                                            <td>: {{date('d-m-Y',strtotime(@$agreements->end_date))}}</td>
                                        </tr>
                                        <tr>
                                            <td>Perpanjangan</td>
                                            <td>: {{ @$agreements->renewal_date}}</td>
                                        </tr>
                                        <tr>
                                            <td>Dokumen Pendukung</td>
                                            <td>: <a href="{{route('download_agreement',['id'=>Crypt::encryptString($agreements->documents)])}}">Download File</a></td>
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
                </div>
            </div>
        </div>
        <!-- [ sample-page ] end -->
    </div>
    <!-- [ Main Content ] end -->
</div>
@endsection
