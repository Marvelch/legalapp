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
                            <a href="{{url('/index_publisher')}}">Utama</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Ubah
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
                <div class="card-body my-3">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-8">
                            <div class="form-group ml-5">
                                <h3>PENERBIT</h3>
                                <small class="text-muted" style="font-family: var(--bs-font-sans-serif)">Pastikan mengisi semua kolom sesuai dengan kebutuhan</small>
                                <!-- <hr style="border: 2px solid #2689e2;"> -->
                            </div>
                        </div>
                        <div class="col-md-8 mt-3">
                            <form action="{{route('update_publisher',['id'=>$items->id])}}" method="post">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <div class="mb-4">
                                        <label class="mb-2 fw-bold"
                                            style="font-family: var(--bs-body-font-Roboto); margin-left: 3px;">Nama
                                            Instansi</label>
                                        <input type="text" name="name"
                                            class="form-control form-control-sm text-capitalize"
                                            value="{{$items->name}}" required>
                                        @error('name')
                                        <p class="text-sm text-danger">*{{ $message }}</p]>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="mb-4">
                                        <label class="mb-2 fw-bold"
                                            style="font-family: var(--bs-body-font-Roboto); margin-left: 3px;">Alamat</label>
                                        <input type="text" name="address"
                                            class="form-control form-control-sm text-capitalize"
                                            value="{{$items->address}}" required>
                                        @error('address')
                                        <p class="text-sm text-danger">*{{ $message }}</p]>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="mb-4 fw-bold">
                                        <label class="mb-2"
                                            style="font-family: var(--bs-body-font-Roboto); margin-left: 3px;">Telepon</label>
                                        <input type="text" name="phone" class="form-control form-control-sm"
                                            value="{{$items->phone}}" required>
                                        @error('phone')
                                        <p class="text-sm text-danger">*{{ $message }}</p]>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group d-flex justify-content-end">
                                    <div class="mb-4 mt-4">
                                        <button class="btn btn-primary text-sm w-100" type="submit">Simpan</button>
                                        <!-- <a class="btn-ok btn-default" style="color: #ffff">simpan</a> -->
                                    </div>
                                </div>
                            </form>
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
