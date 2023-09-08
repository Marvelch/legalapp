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
                            <a href="{{url('/home')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('index_user')}}">Utama</a>
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
                        <div class="col-md-8">
                            <form action="{{route('update_user',['id'=>$users->id])}}" method="post" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <div class="mb-4">
                                        <label class="mb-2" style="margin-left: 3px;">Nama Lengkap</label>
                                        <input type="text" name="name" class="form-control form-control-sm"
                                            value="{{@$users->name}}" required>
                                        @error('name')
                                        <p class="text-sm text-danger">*{{ $message }}</p]>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="mb-4">
                                        <label class="mb-2" style="margin-left: 3px;">Email</label>
                                        <input type="text" name="email" class="form-control form-control-sm"
                                            value="{{@$users->email}}" required>
                                        @error('email')
                                        <p class="text-sm text-danger">*{{ $message }}</p]>
                                            @enderror
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <div class="mb-4">
                                        <label class="mb-2" style="margin-left: 3px;">Telpon</label>
                                        <input type="text" name="phone" class="form-control form-control-sm"
                                            value="{{@$users->phone}}" required>
                                        @error('phone')
                                        <p class="text-sm text-danger">*{{ $message }}</p]>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="mb-4">
                                        <label class="mb-2" style="margin-left: 3px;">Kata Sandi</label>
                                        <input type="text" name="password" class="form-control form-control-sm"
                                            value="{{@$users->password_text}}" required>
                                        @error('password')
                                        <p class="text-sm text-danger">*{{ $message }}</p]>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="mb-4">
                                        <label class="mb-2" style="margin-left: 3px;">Level</label>
                                        <select name="type" id="publisher"
                                            class="form-control form-control-sm text-capitalize"
                                            style="width: 100%;" required>
                                            <option value="0" {{$users->type == 'user' ? 'selected' : ''}}>Users (Pengguna)</option>
                                            <option value="1" {{$users->type == 'manager' ? 'selected' : ''}}>Manager</option>
                                            <option value="2" {{$users->type == 'admin' ? 'selected' : ''}}>Admin</option>
                                        </select>
                                        @error('type')
                                        <p class="text-sm text-danger">*{{ $message }}</p]>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group d-flex justify-content-end">
                                    <div class="mb-4 mt-4">
                                        <button class="btn btn-primary text-sm" type="submit">Simpan</button>
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
