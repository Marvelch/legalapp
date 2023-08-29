@extends('layouts.base')

@section('content')
<div class="pc-content">
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Licensing</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{url('/home')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Show
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
                <div class="card-body my-5 d-flex justify-content-center">
                    <div class="col-10 mt-4">
                        <div class="card">
                            <div class="card-body m-4">
                                <div class="row">
                                    <div class="col-m-8">
                                        <div class="table-responsive m-2">
                                            <table class="table table-borderless" id="legalentity-table">
                                                <tbody style="font-size: 13px;">
                                                    <tr>
                                                        <td>Nama Mail Server</td>
                                                        <td>: {{strtoupper($mail->mail_server)}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>SMTP / Host</td>
                                                        <td>: {{ucfirst($mail->smtp)}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>PORT</td>
                                                        <td>: {{strtoupper($mail->port)}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Username / Email</td>
                                                        <td>: {{@ucfirst($mail->username)}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Password</td>
                                                        <td>: {{@$mail->password}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Keterangan</td>
                                                        <td>: {{@ucfirst($mail->description)}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <?php
                                        $domain = explode('@',$mail->username);

                                        if ($domain == 'gmail.com') {
                                            echo "<img src='https://mailmeteor.com/logos/assets/PNG/Gmail_Logo_512px.png' witdh='100%' alt='' srcset=''>";
                                        }elseif($domain == 'yahoo.com'){
                                            echo "<img src='https://logos-world.net/wp-content/uploads/2022/05/Yahoo-Mail-Logo.png' witdh='100%' alt='' srcset=''>";
                                        }elseif($domain == 'skbfood.com'){
                                            echo "<img src='https://sekarbumi.com/wp-content/uploads/2022/10/Logo-SKB-Horizontal-01-1-1.png' witdh='100%' alt='' srcset=''>";
                                        }else{
                                            
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
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
