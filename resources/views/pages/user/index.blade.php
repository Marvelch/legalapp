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
                        <li class="breadcrumb-item" aria-current="page">
                            Utama
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
                <div class="card-body my-1">
                    <div class="row">
                        <div class="col">
                            
                        </div>
                        <div class="col-auto">
                            <div class="btn-group">
                                <a type="button" class="dropdown-toggle arrow-none"
                                    data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none; margin-right: 20px;">
                                    <i class="ti bi-three-dots-vertical"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <div class="row">
                                            <div class="col-auto">
                                                <a class="dropdown-item" style="font-size: 12px; font-family: var(--bs-font-sans-nunito)" href="{{route('create_user')}}">Tambah Pengguna</a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered" id="legalentity-table">
                        <thead>
                            <tr style="font-size: 13px;">
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Kata Sandi</th>
                                <th>Level</th>
                                <th>Bantuan</th>
                            </tr>
                        </thead>
                        <tbody class="text-uppercase" style="font-size: 11px;">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- [ sample-page ] end -->
    </div>
    <!-- [ Main Content ] end -->
</div>
<script>
    $(document).ready(function() {
        $('#legalentity-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("table_user") }}',
            columns: [
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'password_text', name: 'password_text'},
                {data: 'level', name: 'level'},
                {data: 'action', name: 'action'},
            ]
        });
    });
</script>
@endsection
