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
                        <li class="breadcrumb-item">
                            <a href="{{url('/show_company')}}">Utama</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Buat Baru
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
                            <h3><i class="bi bi-bookmark-check-fill text-success"></i> <span
                                    class="h5 text-uppercase">Perusahaan Baru</span></h3>
                            <p class="sub_title text-muted ml-1">Penghatikan penginputan setiap kolom untuk menghindari
                                kesalahan pada sistem.</p>
                            <hr class="sub_hr">
                            <form action="{{route('store_company')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <div class="mb-4">
                                        <label class="mb-2"
                                            style="font-family: var(--bs-body-font-Roboto); margin-left: 3px;">Nama
                                            Perusahaan</label>
                                        <input type="text" name="name" class="form-control form-control-sm"
                                            value="{{old('name')}}" required>
                                        @error('name')
                                        <p class="text-sm text-danger">*{{ $message }}</p]>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="mb-4">
                                        <label class="mb-2">Pilih Kota</label>
                                        <select name="regions" class="regions" id="regions"
                                            class="form-control form-control-sm" name="state"
                                            style="width: 100%; text-transform:uppercase;" required>
                                        </select>
                                        @error('regions')
                                        <p class="text-sm text-danger">*{{ $message }}</p]>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row g-3 mb-4">
                                        <div class="col-sm-11">
                                            <label class="mb-2"
                                                style="font-family: var(--bs-body-font-Roboto); margin-left: 3px;">Alamat</label>
                                            <input type="text" name="address" class="form-control form-control-sm"
                                                value="{{old('address')}}" required>
                                            @error('address')
                                            <p class="text-sm text-danger">*{{ $message }}</p]>
                                                @enderror
                                        </div>
                                        <div class="col-sm-auto">
                                            <button class="btn btn-primary btn-sm mt-4" disabled><i class="bi bi-send-x"></i></button>
                                        </div>
                                    </form>
                                </div>
                                <div class="form-group">
                                    <div class="mb-4">
                                        <label class="mb-2"
                                            style="font-family: var(--bs-body-font-Roboto); margin-left: 3px;">Divisi
                                            Perusahaan</label>
                                        <select name="division" class="form-select form-select-sm"
                                            aria-label=".form-select-sm example" required>
                                            @foreach($items as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="mb-4">
                                        <label class="mb-2"
                                            style="font-family: var(--bs-body-font-Roboto); margin-left: 3px;">Keterangan</label>
                                        <textarea name="information" id="" cols="30" rows="4"
                                            class="form-control"></textarea>
                                    </div>
                                    @error('information')
                                    <p class="text-sm text-danger">*{{ $message }}</p]>
                                        @enderror
                                </div>
                                <div class="form-group d-flex justify-content-end mt-2">
                                    <button class="btn btn-primary btn-flat text-sm" type="submit"
                                        style="border-radius: 0px;">Simpan</button>
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
    $('#regions').select2({
        minimumInputLength: 3,
        ajax: {
            url: '{{route("searching_region")}}',
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
