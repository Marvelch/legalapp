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
                <div class="card-body my-5">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-4">
                            <div class="card" style="border-right: 0.2rem solid #54b95b;">
                                <div class="card-body">
                                    <h6>Ketentuan Perubahaan Data</h6>
                                    <span style="font-size: 11px;">Perubahan layanan Legal</span>
                                    <hr>
                                    <ul style="font-size: 11px;">
                                        <li>Bila <span class="fw-bold">user</span> melakukan perubahan pada <span class="fw-bold">master</span>, maka penginputan data yang sudah dilakukan akan mengikuti sesuai perubahan data pada <span class="fw-bold">master</span> terbaru.</li>
                                        <li>Harap mengisi semua <span class="fw-bold">field</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <form action="{{route('update_legal',['id'=>$legal->id])}}" method="post">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <div class="mb-4">
                                        <label class="mb-2" style="font-family: var(--bs-body-font-Roboto);">Badan
                                            Hukum</label>
                                        <input type="text" name="name" class="form-control form-control-sm text-uppercase" value="{{$legal->name}}">
                                        @error('name')
                                        <p class="text-sm text-danger">*{{ $message }}</p]>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="mb-4">
                                        <label class="mb-2"
                                            style="font-family: var(--bs-body-font-Roboto);">Alamat</label>
                                        <input type="text" name="address" class="form-control form-control-sm text-capitalize" value="{{$legal->address}}">
                                         @error('address')
                                        <p class="text-sm text-danger">*{{ $message }}</p]>
                                            @enderror
                                        </div>
                                </div>
                                <div class="form-group">
                                    <div class="mb-4">
                                        <label class="mb-2" style="font-family: var(--bs-body-font-Roboto);">Divisi
                                            Perusahaan</label>
                                        <select name="division" class="form-select form-select-sm"
                                            aria-label=".form-select-sm example">
                                            @foreach($devision as $item)
                                            <option value="{{$item->id}}" {{$item->id == $legal->division_id ? 'selected' : ''}}>{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="mb-4">
                                        <label class="mb-2"
                                            style="font-family: var(--bs-body-font-Roboto);">Keterangan</label>
                                        <textarea name="description" id="" cols="30" rows="4"
                                            class="form-control form-control-sm text-capitalize" placeholder="" value="{{$legal->description}}"></textarea>
                                             @error('description')
                                        <p class="text-sm text-danger">*{{ $message }}</p]>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group d-md-flex justify-content-md-end">
                                    <button class="btn btn-primary text-sm mb-4" type="submit">Simpan</button>
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
