@extends('layouts.base')

@section('content')
<div class="pc-content">
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Publishers</h5>
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
                    {{ $dataTable->table() }}
                    <!-- <table class="table table-bordered" id="legalentity-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Badan Hukum</th>
                                <th>Alamat</th>
                                <th>Divisi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table> -->
                </div>
            </div>
        </div>
        <!-- [ sample-page ] end -->
    </div>
    <!-- [ Main Content ] end -->
</div>
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
<!-- <script>
    $(document).ready(function() {
        $('#legalentity-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ url("/legal/legal-data") }}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'address', name: 'address'},
                {data: 'divisions', name: 'divisions'},
            ]
        });
    });
</script> -->
@endsection
