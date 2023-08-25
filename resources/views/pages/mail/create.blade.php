@extends('layouts.base')

@section('content')
<div class="pc-content">
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Company</h5>
                    </div>
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
                            <form action="{{route('store_company')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <div class="mb-4">
                                        <label class="mb-2" style="font-family: var(--bs-body-font-Roboto); margin-left: 3px;">Mail Server</label>
                                        <input type="text" name="name" class="form-control form-control-sm" value="{{old('name')}}">
                                        @error('name')
                                        <p class="text-sm text-danger">*{{ $message }}</p]>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="mb-4">
                                        <label class="mb-2"
                                            style="font-family: var(--bs-body-font-Roboto); margin-left: 3px;">Port</label>
                                        <input type="text" name="address" class="form-control form-control-sm" value="{{old('address')}}">
                                         @error('address')
                                        <p class="text-sm text-danger">*{{ $message }}</p]>
                                            @enderror
                                        </div>
                                </div>
                                <div class="form-group">
                                    <div class="mb-4">
                                        <label class="mb-2" style="font-family: var(--bs-body-font-Roboto); margin-left: 3px;">Divisi
                                            Perusahaan</label>
                                        <select name="division" class="form-select form-select-sm"
                                            aria-label=".form-select-sm example">
                                            @foreach($items as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
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
@endsection
