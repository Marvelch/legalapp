<!-- [ Sidebar Menu ] start -->
<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="{{url('/')}}" class="b-brand">
                <!-- ========   Change your logo from here   ============ -->
                <img src="{{asset('./images/logo/skb.png')}}" alt="" class="logo logo-lg" width="85%" />
            </a>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar" style="">
                <li class="pc-item pc-caption">
                    <i class="ti ti-dashboard"></i>
                </li>
                <li class="pc-item">
                    <a href="{{url('/home')}}" class="pc-link"><span class="pc-micon"><i class="bi bi-house-fill"></i></span><span class="pc-mtext">Dashboard</span></a>
                </li>
                <!-- <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link"><span class="pc-micon"><i class="ti ti-book"></i></span><span
                            class="pc-mtext">Badan Hukum</span><span class="pc-arrow"><i
                                class="ti ti-chevron-right"></i></span></a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="{{route('index_legal')}}">Data</a></li>
                        <li class="pc-item"><a class="pc-link" href="{{route('create_legal')}}">Buat Baru</a></li>
                    </ul>
                </li> -->
                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link"><span class="pc-micon"><i class="bi bi-person-fill-check"></i></span><span
                            class="pc-mtext">Penerbit</span><span class="pc-arrow"><i
                                class="ti ti-chevron-right"></i></span></a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="{{route('index_publisher')}}">Data</a>
                        </li>
                        <li class="pc-item"><a class="pc-link"
                                href="{{route('create_publisher')}}">Buat Baru</a></li>
                    </ul>
                </li>
                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link"><span class="pc-micon"><i class="bi bi-file-bar-graph"></i></span><span
                            class="pc-mtext">Perusahaan</span><span class="pc-arrow"><i
                                class="ti ti-chevron-right"></i></span></a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="{{route('index_company')}}">Data</a>
                        </li>
                        <li class="pc-item"><a class="pc-link"
                                href="{{route('create_company')}}">Buat Baru</a></li>
                    </ul>
                </li>
                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link"><span class="pc-micon"><i class="bi bi-file-earmark-pdf-fill"></i></span><span
                            class="pc-mtext">Perizinan</span><span class="pc-arrow"><i
                                class="ti ti-chevron-right"></i></span></a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="{{route('index_licensing')}}">Data</a>
                        </li>
                        <li class="pc-item"><a class="pc-link"
                                href="{{route('create_licensing')}}">Buat Baru</a></li>
                    </ul>
                </li>
                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link"><span class="pc-micon"><i class="bi bi-file-earmark-lock2-fill"></i></span><span
                            class="pc-mtext">Perjanjian</span><span class="pc-arrow"><i
                                class="ti ti-chevron-right"></i></span></a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="{{route('index_agreement')}}">Data</a>
                        </li>
                        <li class="pc-item"><a class="pc-link"
                                href="{{route('create_agreement')}}">Buat Baru</a></li>
                    </ul>
                </li>

                <!-- <li class="pc-item pc-caption">
                    <label>Company</label>
                    <i class="ti ti-apps"></i>
                </li>
                <li class="pc-item">
                    <a class="pc-link"><span class="pc-micon"><i class="ti ti-typography"></i></span><span
                            class="pc-mtext">Typography</span></a>
                </li>
                <li class="pc-item">
                    <a href="../elements/bc_color.html" class="pc-link"><span class="pc-micon"><i
                                class="ti ti-brush"></i></span><span class="pc-mtext">Color</span></a>
                </li>
                <li class="pc-item">
                    <a href="https://tablericons.com" class="pc-link" target="_blank"><span class="pc-micon"><i
                                class="ti ti-plant-2"></i></span><span class="pc-mtext">Tabler</span><span
                            class="pc-arrow"></a>
                </li>

                <li class="pc-item pc-caption">
                    <label>Other</label>
                    <i class="ti ti-brand-chrome"></i>
                </li> -->
                @if(Auth::user()->type == 'admin')
                <li class="pc-item"><a href="{{route('index_user')}}" class="pc-link"><span class="pc-micon"><i class="bi bi-person-fill-lock"></i></span><span class="pc-mtext">Pengguna</span></a></li>
                <li class="pc-item"><a href="{{route('index_mail')}}"
                        class="pc-link"><span class="pc-micon"><i class="bi bi-inbox-fill"></i></span><span
                            class="pc-mtext">Mail</span></a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
<!-- [ Sidebar Menu ] end -->
