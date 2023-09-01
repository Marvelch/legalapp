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
                            <h2>Buat Perjanjian</h2>
                            <p class="text-muted" style="font-size: 11px;">Pastikan penginputan perjanjian sudah sesuai field terlampir</p>
                        </div>
                        <div class="col-md-8 my-3">
                            <form action="{{route('store_agreement')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="mb-4">
                                        <label class="mb-2">Nama Perjanjian</label>
                                        <input type="text" name="agreement_name" class="form-control form-control-sm"
                                            value="{{old('agreement_name')}}" required>
                                        @error('agreement_name')
                                        <p class="text-sm text-danger">*{{ $message }}</p]>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="mb-4">
                                        <label class="mb-2">Perusahaan</label>
                                        <select name="company" class="company_entity" id="company_entity"
                                            class="form-control form-control-sm" name="state"
                                            style="width: 100%; text-transform:uppercase;" required>
                                        </select>
                                        @error('company')
                                        <p class="text-sm text-danger">*{{ $message }}</p]>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="mb-4">
                                        <label class="mb-2">Nama Counter Party</label>
                                        <input type="text" name="counter_party_name"
                                            class="form-control form-control-sm" value="{{old('counter_party_name')}}" required>
                                        @error('counter_party_name')
                                        <p class="text-sm text-danger">*{{ $message }}</p]>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="mb-4">
                                        <label class="mb-2">Tanggal Penandatangan</label>
                                        <input type="date" name="signing_date" class="form-control form-control-sm"
                                            value="{{ now()->format('Y-m-d') }}" required>
                                        @error('signing_date')
                                        <p class="text-sm text-danger">*{{ $message }}</p]>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="mb-4">
                                        <label class="mb-2">Tanggal Berlaku</label>
                                        <input type="date" name="effective_date" class="form-control form-control-sm"
                                            value="{{ now()->format('Y-m-d') }}" required>
                                        @error('effective_date')
                                        <p class="text-sm text-danger">*{{ $message }}</p]>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="mb-4">
                                        <label class="mb-2">Tanggal Berakhir</label>
                                        <input name="end_date" type="date" name="end_date" class="form-control form-control-sm"
                                            value="{{ now()->format('Y-m-d') }}" required>
                                        @error('end_date')
                                            <p class="text-sm text-danger">*{{ $message }}</p]>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="mb-4">
                                        <label for="">Pembaharuan</label>
                                        <div class="form-check form-switch mt-1">
                                            <input class="form-check-input p-1" type="checkbox" id="renewalCheck"
                                                style="width: 2.3rem; height: 17px;">
                                        </div>
                                        <div class="input-group mb-3 mt-3" id="renewalGroup">
                                            <input name="renewal_date" type="text" id="dateRenewal"
                                                class="form-control form-control-sm" style="height: 30px;">
                                            <span class="input-group-text" style="height: 32px; border-radius: 0px;">Hari</span>
                                        </div>
                                        @error('renewal_date')
                                        <p class="text-sm text-danger">*{{ $message }}</p]>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="mb-4">
                                        <label class="mb-2">Dokumen Pelengkap</label>
                                        <input type="file" name="documents" class="form-control form-control-sm"
                                            value="{{old('documents')}}">
                                        @error('documents')
                                        <p class="text-sm text-danger">*{{ $message }}</p]>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="mb-4">
                                        <label class="mb-2">Keterangan</label>
                                        <textarea name="description" id="" cols="30" rows="4"
                                            class="form-control form-control-sm"></textarea>
                                    </div>
                                </div>
                                <div class="form-group my-5 d-flex justify-content-end">
                                    <button class="btn btn-primary text-sm" type="submit">Simpan</button>
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
    $('#renewalGroup').hide();

    $('#renewalCheck').on('change', function () {
        const x = $('#renewalCheck').is(':checked');
        if (x == true) {
            $('#renewalGroup').show();
        } else {
            $('#renewalGroup').hide();
        }
    });

    $('#company_entity').select2({
        minimumInputLength: 2,
        ajax: {
            url: '{{route("searching_company")}}',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
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
                    results: $.map(data, function (item) {
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
