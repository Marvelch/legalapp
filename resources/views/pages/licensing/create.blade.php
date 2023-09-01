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
                            <form action="{{route('store_licensing')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                 <div class="form-group">
                                    <div class="mb-4">
                                        <label class="mb-2" style="margin-left: 3px;">Badan Hukum</label>
                                        <select name="legal_entity" class="legal_entity" id="legal_entity" class="form-control form-control-sm" name="state" style="width: 100%; text-transform:uppercase;" required>
                                        </select>
                                        @error('legal_entity')
                                            <p class="text-sm text-danger">*{{ $message }}</p]>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="mb-4">
                                        <label class="mb-2"
                                            style="margin-left: 3px;">Nomor Perizinan</label>
                                            <input type="text" name="permit_number" class="form-control form-control-sm" value="{{old('address')}}" required>
                                            @error('permit_number')
                                                <p class="text-sm text-danger">*{{ $message }}</p]>
                                            @enderror
                                        </div>
                                </div>
                                <div class="form-group">
                                    <div class="mb-4">
                                        <label class="mb-2"
                                            style="margin-left: 3px;">Nama Perizinan</label>
                                            <input type="text" name="permit_name" class="form-control form-control-sm" value="{{old('address')}}" required>
                                            @error('permit_name')
                                                <p class="text-sm text-danger">*{{ $message }}</p]>
                                            @enderror
                                        </div>
                                </div>
                                <div class="form-group">
                                    <div class="mb-4">
                                        <label class="mb-2" style="margin-left: 3px;">Nama Instansi</label>
                                        <select name="publisher" id="publisher" name="publisher_id" class="form-control form-control-sm" name="state" style="width: 100%; text-transform:uppercase;" required>
                                        </select>
                                        @error('publisher')
                                            <p class="text-sm text-danger">*{{ $message }}</p]>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="mb-4">
                                        <label class="mb-2"
                                            style="margin-left: 3px;">Tanggal Terbit</label>
                                            <input type="date" name="date_start" class="form-control form-control-sm" value="{{ now()->format('Y-m-d') }}" required>
                                            @error('date_start')
                                                <p class="text-sm text-danger">*{{ $message }}</p]>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="mb-4">
                                        <label class="mb-2"
                                            style="margin-left: 3px;">Tanggal Berlaku</label>
                                            <input type="date" name="date_end" class="form-control form-control-sm" value="{{ now()->format('Y-m-d') }}" required>
                                            @error('date_end')
                                                <p class="text-sm text-danger">*{{ $message }}</p]>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="mb-4">
                                        <label class="mb-2"
                                            style="margin-left: 3px;">Periode Perpanjangan</label>
                                        <div class="input-group mb-3">
                                        <input name="period" type="text" class="form-control" style="height: 30px;">
                                        <span class="input-group-text" id="basic-addon2" style="height: 30px; border-radius: 0px;">Hari</span>
                                        </div>
                                        @error('period')
                                            <p class="text-sm text-danger">*{{ $message }}</p]>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="mb-4">
                                        <label class="mb-2"
                                            style="margin-left: 3px;">Dokumen</label>
                                            <input type="file" name="documents" class="form-control form-control-sm" value="{{ now()->format('Y-m-d') }}">
                                            @error('documents')
                                                <p class="text-sm text-danger">*{{ $message }}</p]>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="mb-4">
                                        <label class="mb-2">Keterangan</label>
                                        <textarea name="description" id="" cols="30" rows="4" class="form-control form-control-sm"></textarea>
                                    </div>
                                </div>
                                <div class="form-group content-justify-end">
                                    <div class="mb-4">
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
<script>
    $('#legal_entity').select2({
    minimumInputLength: 2,
    ajax: {
        url: '{{route("searching_licensing")}}',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
                results: $.map(data, function(item) {
                    return {
                        text: item.name,
                        id: item.id
                    }
                })
            };
        },
        cache: true
    }
});

$('#publisher').select2({
    minimumInputLength: 2,
    ajax: {
        url: '{{route("searching_publisher_licensing")}}',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
                results: $.map(data, function(item) {
                    return {
                        text: item.name,
                        id: item.id
                    }
                })
            };
        },
        cache: true
    }
});
</script>
@endsection
