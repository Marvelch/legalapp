@extends('layouts.base')

@section('content')
<div class="pc-content">
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Mail</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{url('/home')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Index
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
                <div class="card-body my-2">
                    <div class="row">
                        <div class="col">
                            <div class="avtar avtar-lg">
                                <i class="text-white ti bi-three-dots-vertical" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none;"></i>
                            </div>
                        </div>
                        <div class="col-auto mt-2">
                            <div class="btn-group">
                                <a type="button" class="dropdown-toggle arrow-none"
                                    data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none; margin-right: 20px;">
                                    <i class="ti bi-three-dots-vertical"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <div class="row">
                                            <div class="col-auto">
                                                <a class="dropdown-item" style="font-size: 12px; font-family: var(--bs-font-sans-nunito)" href="{{route('create_mail')}}">Tambah Mail Server</a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered" id="mail-table">
                        <thead>
                            <tr style="font-size: 13px;">
                                <th>Mail Server</th>
                                <th>Port</th>
                                <th>SMTP</th>
                                <th>Username</th>
                                <th>Default</th>
                                <th>Bantuan</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 11px;">
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
        $('#mail-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("table_mail") }}',
            columns: [
                {data: 'mail_server', name: 'mail_server'},
                {data: 'port', name: 'port'},
                {data: 'smtp', name: 'smtp'},
                {data: 'username', name: 'username'},
                {data: 'defaultChange', name: 'defaultChange'},
                {data: 'action', name: 'action'},
            ]
        });
    });
</script>
@endsection
