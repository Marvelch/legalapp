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
                            <a href="{{url('/legal')}}">Badan Hukum</a>
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
            <div class="card">
                <div class="card-body my-5">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-8">
                            <div class="card" style="border-left: 0.2rem solid #54b95b;">
                                <div class="card-body">
                                    <h6 class="mt-4" style="margin-left: 10px;">Data Badan Hukum</h6>
                                    <div class="form-group mt-4 text-sm">
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                <tbody>
                                                    <tr class="gap-2">
                                                        <td class="fw-bold">Badan Hukum</td>
                                                        <td class="text-uppercase">: {{@$legal->name}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-bold">Alamat</td>
                                                        <td class="text-capitalize">: {{@$legal->address}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-bold">Divisi</td>
                                                        <td class="text-capitalize">: {{@$legal->divisions->name}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <div class="mb-4">
                                    <label class="mb-2" style="font-family: var(--bs-body-font-Roboto);">Badan
                                        Hukum</label>
                                    <input type="text" name="name" class="form-control form-control-sm text-uppercase"
                                        value="{{$legal->name}}">
                                    @error('name')
                                    <p class="text-sm text-danger">*{{ $message }}</p]>
                                        @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mb-4">
                                    <label class="mb-2" style="font-family: var(--bs-body-font-Roboto);">Alamat</label>
                                    <input type="text" name="address"
                                        class="form-control form-control-sm text-capitalize"
                                        value="{{$legal->address}}">
                                    @error('address')
                                    <p class="text-sm text-danger">*{{ $message }}</p]>
                                        @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mb-4">
                                    <label class="mb-2" style="font-family: var(--bs-body-font-Roboto);">Divisi
                                        Perusahaan</label>
                                    {{$legal->divisions->name}}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mb-4">
                                    <label class="mb-2"
                                        style="font-family: var(--bs-body-font-Roboto);">Keterangan</label>
                                    <textarea name="description" id="" cols="30" rows="4"
                                        class="form-control form-control-sm text-capitalize" placeholder=""
                                        value="{{$legal->description}}"></textarea>
                                    @error('description')
                                    <p class="text-sm text-danger">*{{ $message }}</p]>
                                        @enderror
                                </div>
                            </div>
                            <div class="form-group d-md-flex justify-content-md-end">
                                <button class="btn btn-primary text-sm mb-4" type="submit">Simpan</button>
                            </div> -->
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
