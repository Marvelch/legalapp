@extends('layouts.base')

@section('content')
<div class="row">
    <!-- [ sample-page ] start -->
    <div class="col-xl-6 col-md-12">
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body shadow">
                <table class="table table-border">
                    <tbody>
                        <tr class="text-center text-uppercase">
                            <th>Nama Perizinan</th>
                            <th>Nomor</th>
                            <th>Tanggal Berakhir</th>
                        </tr>
                    </tbody>
                    <tbody>
                        @foreach($licesings as $item)
                        <tr style="font-size: 11px;">
                            <td class="text-capitalize">{{$item->permit_name}}</td>
                            <td class="text-uppercase">{{$item->permit_number}}</td>
                            <td class="text-center">{{date('d-m-Y',strtotime($item->date_end))}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-md-12">
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body shadow">
                <table class="table table-border">
                    <tbody>
                        <tr class="text-center text-uppercase">
                            <th>Nama Perjanjian</th>
                            <th>Counter</th>
                            <th>Tanggal Berakhir</th>
                        </tr>
                    </tbody>
                    <tbody>
                        @foreach($agreements as $item)
                        <tr style="font-size: 11px;">
                            <td class="text-capitalize">{{$item->agreement_name}}</td>
                            <td class="text-uppercase">{{$item->counter_party_name}}</td>
                            <td class="text-center">{{date('d-m-Y',strtotime($item->date_end))}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
