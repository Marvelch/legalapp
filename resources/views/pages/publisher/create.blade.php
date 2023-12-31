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
                            Buat Baru
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
                <div class="card-body my-4">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-8 mt-3">
                            <h3><i class="bi bi-bookmark-check-fill text-success"></i> <span class="h5 text-uppercase">Penerbit Baru</span></h3>
                            <p class="sub_title text-muted ml-1">Perhatikan penginputan setiap kolom untuk menghindari kesalahan pada sistem.</p>
                            <hr class="sub_hr">
                            <form action="{{route('store_publisher')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <div class="mb-4">
                                        <label class="mb-2"
                                            style="font-family: var(--bs-body-font-Roboto); margin-left: 3px;">Nama
                                            Instansi</label>
                                        <input type="text" name="name" class="form-control form-control-sm"
                                            value="{{old('name')}}" required>
                                        @error('name')
                                        <p class="text-sm text-danger">*{{ $message }}</p]>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="mb-4">
                                        <label class="mb-2"
                                            style="font-family: var(--bs-body-font-Roboto); margin-left: 3px;">Alamat</label>
                                        <input type="text" name="address" class="form-control form-control-sm"
                                            value="{{old('address')}}" required>
                                        @error('address')
                                        <p class="text-sm text-danger">*{{ $message }}</p]>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="mb-4">
                                        <label class="mb-2"
                                            style="font-family: var(--bs-body-font-Roboto); margin-left: 3px;">Telepon</label>
                                        <input type="text" name="phone" class="form-control form-control-sm"
                                            value="{{old('phone')}}" required>
                                        @error('phone')
                                        <p class="text-sm text-danger">*{{ $message }}</p]>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group d-flex justify-content-end">
                                    <div class="mb-4 mt-4">
                                        <button class="btn btn-primary btn-flat text-sm" type="submit" style="border-radius: 0px;">Simpan</button>
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
