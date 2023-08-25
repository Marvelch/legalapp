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
                            Edit
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
                            <form action="{{route('update_agreement',['id'=>$agreements->id])}}" method="post"
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <div class="mb-4">
                                        <label class="mb-2">Nama Perjanjian</label>
                                        <input type="text" name="agreement_name" class="form-control form-control-sm"
                                            value="{{$agreements->agreement_name}}">
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
                                            style="width: 100%; text-transform:uppercase;">
                                        </select>
                                        <input type="hidden" value="{{$agreements->id}}" id="company_id_hidden">
                                        <input type="hidden" value="{{$agreements->companys->name}}"
                                            id="company_name_hidden">
                                        @error('company')
                                        <p class="text-sm text-danger">*{{ $message }}</p]>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="mb-4">
                                        <label class="mb-2">Nama Counter Party</label>
                                        <input type="text" name="counter_party_name"
                                            class="form-control form-control-sm"
                                            value="{{$agreements->counter_party_name}}">
                                        @error('counter_party_name')
                                        <p class="text-sm text-danger">*{{ $message }}</p]>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="mb-4">
                                        <label class="mb-2">Tanggal Penandatangan</label>
                                        <input type="date" name="signing_date" class="form-control form-control-sm"
                                            value="{{$agreements->signing_date}}">
                                        @error('signing_date')
                                        <p class="text-sm text-danger">*{{ $message }}</p]>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="mb-4">
                                        <label class="mb-2">Tanggal Berlaku</label>
                                        <input type="date" name="effective_date" class="form-control form-control-sm"
                                            value="{{$agreements->effective_date}}">
                                        @error('effective_date')
                                        <p class="text-sm text-danger">*{{ $message }}</p]>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="mb-4">
                                        <label class="mb-2">Tanggal Berakhir</label>
                                        <input name="end_date" type="date" name="end_date"
                                            class="form-control form-control-sm" value="{{$agreements->end_date}}">
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
                                                style="width: 2.3rem; height: 17px;"
                                                {{$agreements->renewal_date ? 'checked': ''}}>
                                        </div>
                                        <div class="input-group mb-3 mt-3" id="renewalGroup">
                                            <input name="renewal_date" type="text" id="dateRenewal"
                                                class="form-control form-control-sm" style="height: 30px;"
                                                value="{{$agreements->renewal_date}}">
                                            <span class="input-group-text" style="height: 30px;">hari</span>
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
                                            value="{{$agreements->documents}}">
                                        @error('documents')
                                        <p class="text-sm text-danger">*{{ $message }}</p]>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="mb-4">
                                        <label class="mb-2">Keterangan</label>
                                        <textarea name="description" id="" cols="30" rows="4"
                                            class="form-control form-control-sm">{{$agreements->description}}</textarea>
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
    $('#renewalGroup').hide();

    var $option = $("<option selected></option>").val($('#company_id_hidden').val()).text($('#company_name_hidden').val());

    $('#company_entity').append($option).trigger('change');

    const x = $('#renewalCheck').is(':checked');
    if (x == true) {
        $('#renewalGroup').show();
    } else {
        $('#renewalGroup').hide();
    }

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
