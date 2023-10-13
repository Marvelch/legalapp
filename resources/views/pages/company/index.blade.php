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
                <div class="card-body">
                    <table class="table table-bordered" id="legalentity-table">
                        <thead>
                            <tr style="font-size: 13px;">
                                <th>Badan Hukum</th>
                                <th>Alamat</th>
                                <th>Divisi</th>
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
            buttons: [],
            processing: true,
            serverSide: true,
            ajax: '{{ route("table_company") }}',
            columns: [
                {data: 'name', name: 'name'},
                {data: 'address', name: 'address'},
                {data: 'division', name: 'division'},
                {data: 'action', name: 'action'},
            ]
        });
    });
</script>
@endsection
