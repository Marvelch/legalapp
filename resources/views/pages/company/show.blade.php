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
                            <a href="{{route('index_company')}}">Utama</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Tampilan Informasi
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
                    <div class="col-10 mt-4">
                        <div class="card" style="border-left: 0.2rem solid #54b95b;">
                            <div class="card-body m-4">
                                <h4>Informasi Perusahaan</h4>
                                <p class="sub_title">Pengelolaan informasi perusahaan akan mengikuti data terbaru yang terinput oleh pengguna</p>
                                <hr>
                                <div class="table-responsive my-5">
                                    <table class="table table-borderless" id="legalentity-table">
                                        <tbody class="text-capitalize" style="font-size: 13px;">
                                            <tr>
                                                <td class="fw-bold col-md-3 text-muted">Nama Perusahaan</td>
                                                <td>: {{strtoupper($companys->name)}}</td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold text-muted">Alamat</td>
                                                <td>: {{ucfirst($companys->address)}}</td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold text-muted">Divisi</td>
                                                <td>: {{strtoupper($companys->divisions->name)}}</td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold text-muted">Keterangan</td>
                                                <td>: {{@$companys->information}}</td>
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
