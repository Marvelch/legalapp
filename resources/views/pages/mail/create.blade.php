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
                            <a href="{{url('/legal')}}">Mail</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Create
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
                            <form action="{{route('store_mail')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <div class="mb-4">
                                        <label class="mb-2" style="font-family: var(--bs-body-font-Roboto); margin-left: 3px;">Nama Mail Server</label>
                                        <input type="text" name="mail_server" class="form-control form-control-sm text-lowercase" value="{{old('mail_server')}}">
                                        @error('mail_server')
                                        <p class="text-sm text-danger">*{{ $message }}</p]>
                                            @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label class="mb-2" style="font-family: var(--bs-body-font-Roboto); margin-left: 3px;">Port</label>
                                        <input type="text" name="port" class="form-control form-control-sm text-lowercase" value="{{old('port')}}">
                                        @error('port')
                                        <p class="text-sm text-danger">*{{ $message }}</p]>
                                            @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label class="mb-2" style="font-family: var(--bs-body-font-Roboto); margin-left: 3px;">SMTP</label>
                                        <input type="text" name="smtp" class="form-control form-control-sm text-lowercase" value="{{old('smtp')}}">
                                        @error('smtp')
                                        <p class="text-sm text-danger">*{{ $message }}</p]>
                                            @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label class="mb-2" style="font-family: var(--bs-body-font-Roboto); margin-left: 3px;">Username</label>
                                        <input type="text" name="username" class="form-control form-control-sm text-lowercase" value="{{old('username')}}">
                                        @error('username')
                                        <p class="text-sm text-danger">*{{ $message }}</p]>
                                            @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label class="mb-2" style="font-family: var(--bs-body-font-Roboto); margin-left: 3px;">Password</label>
                                        <input type="text" name="password" class="form-control form-control-sm" value="{{old('password')}}">
                                        @error('password')
                                        <p class="text-sm text-danger">*{{ $message }}</p]>
                                            @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label class="mb-2" style="font-family: var(--bs-body-font-Roboto); margin-left: 3px;">Keterangan</label>
                                        <textarea name="description" id="" cols="30" rows="4" class="form-control form-control-sm"  value="{{old('description')}}"></textarea>
                                        @error('description')
                                        <p class="text-sm text-danger">*{{ $message }}</p]>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group d-md-flex justify-content-md-end">
                                    <button class="btn btn-primary text-sm" type="submit">Simpan</button>
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
