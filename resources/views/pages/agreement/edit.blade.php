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
                            <h3><i class="bi bi-arrow-down-right-circle text-success"></i> <span
                                    class="h5 text-uppercase">Ubah Perjanjian</span></h3>
                            <p class="sub_title text-muted ml-1">Perhatikan penginputan pada sistem legal, pastikan semua kolom terisi.</p>
                            <hr class="sub_hr">
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
                                        <select name="company" class="company" id="company"
                                            class="form-control form-control-sm" name="state"
                                            style="width: 100%; text-transform:uppercase;">
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
                                            class="form-control form-control-sm"
                                            value="{{$agreements->counter_party_name}}">
                                        @error('counter_party_name')
                                        <p class="text-sm text-danger">*{{ $message }}</p]>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="mb-4">
                                        <label class="mb-2">Tanggal Tanda Tangan</label>
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
                                <div class="form-group pt-2">
                                    <div class="mb-4">
                                        <table class="table table-bordered text-sm" style="border-radius: 10px;">
                                            <tbody>
                                                <tr>
                                                    <td class="col-md-6 text-sm text-center"><i
                                                            class="bi bi-calendar-date"
                                                            style="font-size: 15px; margin-right: 10px;"></i> <span
                                                            style="margin-left: 20xp;">Pilih Tanggal Berakhir</span>
                                                    </td>
                                                    <td class="d-flex justify-content-center">
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input check_date_period" name="check_date_period"
                                                                type="checkbox" id="flexSwitchCheckDefault"
                                                                style="width: 35px; height: 20px;" {{$agreements->check_date_period ? 'checked' : ''}}>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="hihow">
                                    <div class="form-group">
                                        <div class="mb-4">
                                            <label class="mb-2" style="margin-left: 3px;">Tanggal Berakhir</label>
                                            <input type="date" name="date_end" class="form-control form-control-sm"
                                                value="{{ date('Y-m-d',strtotime($agreements->date_end)) }}" required>
                                            @error('date_end')
                                            <p class="text-sm text-danger">*{{ $message }}</p]>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="mb-4">
                                            <label class="mb-2" style="margin-left: 3px;">Periode Perpanjangan</label>
                                            <div class="input-group mb-3">
                                                <input name="period" type="text" class="form-control"
                                                    style="height: 30px;"  value="{{$agreements->period}}">
                                                <span class="input-group-text" id="basic-addon2"
                                                    style="height: 30px; border-radius: 0px;">hari</span>
                                            </div>
                                            @error('period')
                                            <p class="text-sm text-danger">*{{ $message }}</p]>
                                                @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group mt-4 hdtuto control-group lst increment">
                                        <input type="file" name="documents[]" class="myfrm form-control form-control-sm">
                                        <div class="input-group-btn">
                                            <button class="btn btn-success btn-sm" type="button" style="border-radius: 0px 2px 2px 0px;"><i class="bi bi-plus-circle pt-1"></i></button>
                                        </div>
                                    </div>
                                    <div class="clone hide">
                                        <div class="hdtuto control-group lst input-group" style="margin-top:10px">
                                            <input type="file" name="documents[]" class="myfrm form-control form-control-sm">
                                            <div class="input-group-btn">
                                                <button class="btn btn-danger btn-sm" type="button" style="border-radius: 0px 2px 2px 0px;"><i class="bi bi-dash-circle"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="mb-4">
                                        <label class="mb-2">Keterangan</label>
                                        <textarea name="description" id="" cols="30" rows="4" class="form-control form-control-sm text-capitalize">{{$agreements->description}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group d-flex justify-content-end my-4">
                                    <button class="btn btn-primary btn-flat text-sm" type="submit"
                                        style="border-radius: 0px;">Perbaharui</button>
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
    $('.hide').hide();

    $('#renewalGroup').hide();

    // var $option = $("<option selected></option>").val($('#company_id_hidden').val()).text($('#company_name_hidden').val());

    // $('#company').append($option).trigger('change');

    var regencyOption = new Option(<?php echo json_encode($agreements->companys->name) ?>, <?php echo json_encode($agreements->companys->id) ?>, false, false);
    $('#company').append(regencyOption).trigger('change');

    if($(".check_date_period").is(':checked')){
        $('.hihow').show();
    }else{
        $('.hihow').hide();
    }

    $('.check_date_period').on('change', function () {
        if ($(this).is(':checked')) {
            $('.hihow').show();
        } else {
            $('.hihow').hide();
        }
    });

    $(document).ready(function () {
        var clone = 0;

        $(".btn-success").click(function () {
            var lsthmtl = $(".clone").html();
            $(".increment").after(lsthmtl);
            clone++;
        });

        $("body").on("click", ".btn-danger", function () {
            $(this).parents(".hdtuto").remove();
            clone--;
        });
    });

    $('#company').select2({
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

</script>
@endsection
