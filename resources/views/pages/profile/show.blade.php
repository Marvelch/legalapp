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
            <div class="card bg-light">
                <div class="card-body m-5 my-5">
                    <div class="row gx-5 d-flex justify-content-center">
                        <div class="col-md-4">
                            <img src="{{asset('./images/user/avatar-1.png')}}" width="100%" alt="user-image"
                                class="user-avtar" />
                            <!-- <button class="btn btn-primary mt-2 w-100 opacity-75" style="border-radius: 0px;"><i class="bi bi-pencil-square"></i> Edit Profile</button> -->
                        </div>
                        <div class="col-md-8">
                            <div class="d-flex bd-highlight">
                                <div class="me-auto bd-highlight">
                                    <h3 class="text-muted">{{Auth::user()->name}} </h3>
                                </div>
                                <div class="bd-highlight"><a
                                        href="{{route('edit_profile',['id'=>Crypt::encryptString(Auth::user()->id)])}}"><i
                                            class="bi bi-qr-code-scan text-primary"></i> <span class="text-sm">Edit
                                            Profile</span></a></div>
                            </div>
                            <small class="text-primary opacity-75">Divisi Legal PT Sekar Bumi Group</small>
                            <hr class="mt-4 mb-4">
                            <small class="text-muted fw-bold">Informasi Tentang Pengguna</small>
                            <table class="table table-borderless mt-4 mb-4">
                                <tbody class="text-sm">
                                    <tr>
                                        <td class="col-sm-2">Email</td>
                                        <td>: {{Auth::user()->email}}</td>
                                    </tr>
                                    <tr>
                                        <td>Telepon</td>
                                        <td>: {{Auth::user()->phone}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <small class="text-muted fw-bold">Informasi Tambahan</small>
                            <table class="table table-borderless mt-3">
                                <tbody class="text-sm">
                                    <tr>
                                        <td class="col-sm-2">Level</td>
                                        <td>: </td>
                                    </tr>
                                </tbody>
                            </table>
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
