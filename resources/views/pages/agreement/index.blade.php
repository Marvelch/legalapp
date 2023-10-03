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
                            <tr style="font-size: 12px;" class="text-uppercase">
                                <th>Perjanjian</th>
                                <th>Perusahaan</th>
                                <th>Counter Party</th>
                                <th>Tanggal Berakhir</th>
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
            ajax: '{{ route("table_agreement") }}',
            columns: [
                {data: 'agreement_name', name: 'agreement_name'},
                {data: 'company', name: 'company'},
                {data: 'counter_party_name', name: 'counter_party_name'},
                {data: 'date_end', name: 'date_end'},
                {data: 'action', name: 'action'},
            ]
        });
    });
</script>
@endsection
