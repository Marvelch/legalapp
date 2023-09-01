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
                <div class="card-body my-2">
                    <table class="table table-bordered" id="publisher-table">
                        <thead>
                            <tr style="font-size: 13px;">
                                <th>Badan Hukum</th>
                                <th>Alamat</th>
                                <th>Telpon</th>
                                <th>Bantuan</th>
                            </tr>
                        </thead>
                        <tbody class="text-capitalize" style="font-size: 11px;">
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
        $('#publisher-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("table_publisher") }}',
            columns: [
                {data: 'name', name: 'name'},
                {data: 'address', name: 'address'},
                {data: 'phone', name: 'phone'},
                {data: 'action', name: 'action'},
            ]
        });
    });
</script>
@endsection
