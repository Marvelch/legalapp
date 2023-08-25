@extends('layouts.base')

@section('content')
<div class="pc-content">
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Licensing</h5>
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
                                            <td>No Perizinaan</td>
                                            <td>: {{strtoupper($licensings->permit_number)}}</td>
                                        </tr>
                                        <tr>
                                            <td>Nama Perizinaan</td>
                                            <td>: {{ucfirst($licensings->permit_name)}}</td>
                                        </tr>
                                        <tr>
                                            <td>Badan Hukum</td>
                                            <td>: {{strtoupper($licensings->legals->name)}}</td>
                                        </tr>
                                        <tr>
                                            <td>Nama Instansi</td>
                                            <td>: {{strtoupper($licensings->publishers->name)}}</td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Terbit</td>
                                            <td>: {{date('d-m-Y',strtotime($licensings->date_start))}}</td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Berlaku</td>
                                            <td>: {{date('d-m-Y',strtotime($licensings->date_end))}}</td>
                                        </tr>
                                        <tr>
                                            <td>Waktu Perpanjangan (hari)</td>
                                            <td>: {{ $licensings->period}}</td>
                                        </tr>
                                        <tr>
                                            <td>Waktu Perpanjangan</td>
                                            <td>: {{date('d-m-Y',strtotime($licensings->extra_time))}}</td>
                                        </tr>
                                        <tr>
                                            <td>Dokumen Pendukung</td>
                                            <td>: <a href="{{route('download_licensing',['id'=>Crypt::encryptString($licensings->documents)])}}">Download File</a></td>
                                        </tr>
                                        <tr>
                                            <td>Keterangan</td>
                                            <td>: {{ $licensings->description}}</td>
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
