@extends('layouts.base')

@section('content')
<div class="pc-content">
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Users</h5>
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
                <div class="card-body my-5">
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
