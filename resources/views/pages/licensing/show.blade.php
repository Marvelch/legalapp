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
                            <a href="{{url('/home')}}">Utama</a>
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
                    <div class="col-10 mt-4">
                        <div class="card" style="border-left: 0.2rem solid #54b95b;">
                            <div class="card-body m-4">
                                <div class="row justify-content-between">
                                    <div class="col-8">
                                        <h5><i class="fa-solid fa-file-circle-check fa-lg"></i><span style="margin-left: 10px;">Data Perizinan</span></h5>
                                        <p class="sub_title">Periksa kembali setiap dokumen yang telah dibuat. Print sebagai bentuk fisik untuk dokumen perizinan</p>
                                    </div>
                                    <div class="col-4 my-2 d-flex justify-content-end">
                                        <a class="btn btn-success btn-flat shadow m-1" style="border-radius: 2px; height: 35px;" title="Edit Perizinan" href="{{route('edit_licensing',['id'=>Crypt::encryptString($licensings->id)])}}"><i class="bi bi-pencil-fill" style="font-size: 15px;"></i></a>
                                        <!-- <button class="btn btn-success btn-flat shadow m-1" style="border-radius: 2px; height: 35px;" title="Print Perizinan"><i class="bi bi-printer-fill" style="font-size: 15px;"></i></button> -->
                                        <button class="btn btn-success btn-flat shadow m-1" style="border-radius: 2px; height: 35px;" title="Dokumen" data-bs-toggle="modal" data-bs-target="#documentModal"><i class="bi bi-files" style="font-size: 15px;"></i></button>
                                    </div>
                                </div>
                                <hr class="shadow">
                                <div class="table-responsive m-2">
                                    <table class="table table-borderless" id="legalentity-table">
                                        <tbody class="text-capitalize" style="font-size: 13px;">
                                            <tr>
                                                <td>No Perizinaan</td>
                                                <td>: {{strtoupper(@$licensings->permit_number)}}</td>
                                            </tr>
                                            <tr>
                                                <td>Nama Perizinaan</td>
                                                <td>: {{ucfirst(@$licensings->permit_name)}}</td>
                                            </tr>
                                            <tr>
                                                <td>Nama Instansi</td>
                                                <td class="text-uppercase">: {{@$licensings->publishers->name}}</td>
                                            </tr>
                                            <tr>
                                                <td>Nama Perusahaan</td>
                                                <td class="text-uppercase">: {{@$licensings->companys->name}} - {{@$licensings->companys->regions->name}}</td>
                                            </tr>
                                            <tr>
                                                <td>Alamat Perusahaan</td>
                                                <td>: {{@$licensings->companys->regions->name}} - {{@$licensings->companys->address}}</td>
                                            </tr>
                                            <tr>
                                                <td>Divisi</td>
                                                <td>: {{@$licensings->companys->divisions->name}}</td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Terbit</td>
                                                <td>: {{date('d-m-Y',strtotime(@$licensings->date_start))}}</td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Berlaku</td>
                                                <td>: {{@date('d-m-Y',strtotime($licensings->date_end))}}</td>
                                            </tr>
                                            <tr>
                                                <td>Waktu Perpanjangan (hari)</td>
                                                <td>: {{ $licensings->period}}</td>
                                            </tr>
                                            <tr>
                                                <td>Waktu Perpanjangan</td>
                                                <td>: {{date('d-m-Y',strtotime(@$licensings->add_date))}}</td>
                                            </tr>
                                            <tr>
                                                <td>Keterangan</td>
                                                <td>: {{ @$licensings->description}}</td>
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
<!-- Modal -->
<div class="modal fade" id="documentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header fw-bold">
        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
      </div>
      <div class="modal-body">
        @foreach($licensings->documents as $item)
            <table class="table table-striped">
                <tbody class="text-sm">
                    <tr>
                        <td class="col-md-10">{{$item->file_name}}</td>
                        <td><a href="{{route('download_licensing',['id'=>Crypt::encryptString($item->path)])}}" style="font-size: 15px;"><i class="fa-solid fa-file-arrow-down fa-xl"></i></a></td>
                    </tr>
                </tbody>
            </table>
        @endforeach
      </div>
      <div class="modal-footer">
        <button type="button" class="btn text-sm btn-primary" data-bs-dismiss="modal" style="border-radius: 2px;">Tutup</button>
      </div>
    </div>
  </div>
</div>
@endsection
