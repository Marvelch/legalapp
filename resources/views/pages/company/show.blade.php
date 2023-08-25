@extends('layouts.base')

@section('content')
<div class="pc-content">
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Company</h5>
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
                                            <td>Nama Perusahaan</td>
                                            <td>: {{strtoupper($companys->name)}}</td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td>: {{ucfirst($companys->address)}}</td>
                                        </tr>
                                        <tr>
                                            <td>Divisi</td>
                                            <td>: {{strtoupper($companys->divisions->name)}}</td>
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
