@extends('layouts.base')

@section('content')
<div class="pc-content">
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <!-- <div class="page-header-title">
                        <h5 class="m-b-10">Publisher</h5>
                    </div> -->
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{url('/home')}}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{url('/home')}}">Profile</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Edit
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
            <div class="card bg-light">
                <div class="card-body m-5 my-5">
                    <form action="{{route('update_profile',['id'=>Auth::user()->id])}}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-8">
                                <h4 class="opacity-75 mt-4"><i class="bi bi-lock-fill"></i> Ganti Kata Sandi</h4>
                                <p class="text-sm text-muted">Pastikan untuk selalu mengganti kata sandi secara berkala.</p>
                                <div class="form-group my-4 text-muted">
                                    <label for="" class="fw-bold">Nama Lengkap</label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{Auth::user()->name}}" disabled>
                                    @error('name')
                                    <p class="text-sm text-danger">*{{ $message }}</p]>
                                        @enderror
                                </div>
                                <div class="form-group text-muted">
                                    <label for="" class="fw-bold">Email</label>
                                    <input type="text" name="email" class="form-control"
                                        value="{{@Auth::user()->email}}" disabled>
                                        @error('email')
                                    <p class="text-sm text-danger">*{{ $message }}</p]>
                                        @enderror
                                </div>
                                <div class="form-group text-muted">
                                    <label for="" class="fw-bold">Kata Sandi</label>
                                    <input type="text" name="password" class="form-control form-control-sm"
                                        value="{{@Auth::user()->password_text}}">
                                    @error('password')
                                    <p class="text-sm text-danger">*{{ $message }}</p]>
                                        @enderror
                                </div>
                                <div class="row">
                                    <div class="form-group d-flex justify-content-end mt-3">
                                        <button class="btn btn-primary col-md-2">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- [ sample-page ] end -->
    </div>
    <!-- [ Main Content ] end -->
</div>
@endsection
