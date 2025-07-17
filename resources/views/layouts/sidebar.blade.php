<aside class="sidebar sidebar-default sidebar-white sidebar-base navs-rounded-all ">
    <div class="sidebar-header d-flex align-items-center justify-content-start">
        <a href="../dashboard/index.html" class="navbar-brand">
            <!--Logo start-->
            <!--logo End-->

            <!--Logo start-->
            {{-- <div class="logo-main">
                <div class="logo-normal">
                    <svg class=" icon-30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2"
                            transform="rotate(-45 -0.757324 19.2427)" fill="currentColor" />
                        <rect x="7.72803" y="27.728" width="28" height="4" rx="2"
                            transform="rotate(-45 7.72803 27.728)" fill="currentColor" />
                        <rect x="10.5366" y="16.3945" width="16" height="4" rx="2"
                            transform="rotate(45 10.5366 16.3945)" fill="currentColor" />
                        <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2"
                            transform="rotate(45 10.5562 -0.556152)" fill="currentColor" />
                    </svg>
                </div>
                <div class="logo-mini">
                    <svg class=" icon-30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2"
                            transform="rotate(-45 -0.757324 19.2427)" fill="currentColor" />
                        <rect x="7.72803" y="27.728" width="28" height="4" rx="2"
                            transform="rotate(-45 7.72803 27.728)" fill="currentColor" />
                        <rect x="10.5366" y="16.3945" width="16" height="4" rx="2"
                            transform="rotate(45 10.5366 16.3945)" fill="currentColor" />
                        <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2"
                            transform="rotate(45 10.5562 -0.556152)" fill="currentColor" />
                    </svg>
                </div>
            </div> --}}
            <!--logo End-->




            {{-- <h4 class="logo-title">STKIP TUAL</h4> --}}
            <div class="d-flex justify-content-center">
                <img class="w-50"  src="{{ asset('/admin/images/logo/bg-univ.jpeg') }}" alt="">
            </div>
        </a>
        <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
            <i class="icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.25 12.2744L19.25 12.2744" stroke="currentColor" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M10.2998 18.2988L4.2498 12.2748L10.2998 6.24976" stroke="currentColor"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </i>
        </div>
    </div>
    <div class="sidebar-body pt-0 data-scrollbar">
        <div class="sidebar-list">
            <ul class="navbar-nav iq-main-menu" id="sidebar-menu" style="overflow-y: auto ; height : 26rem">
                <li class="nav-item static-item">
                    <a class="nav-link static-item disabled" href="#" tabindex="-1">
                        <span class="default-icon">Master</span>
                        <span class="mini-icon">-</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('home') ? 'active' : '' }}" aria-current="page" href="/home">
                        @include('icons.home-icon')
                        <span class="item-name">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('artikel*') ? 'active' : '' }}" aria-current="page" href="/artikel">
                        @include('icons.house-icon')
                        <span class="item-name">Artikel</span>
                    </a>
                </li> 
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('struktur-organisasi*') ? 'active' : '' }}" aria-current="page" href="/struktur-organisasi">
                        @include('icons.user-icon')
                        <span class="item-name">Struktur Organisasi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('alumni*') ? 'active' : '' }}" aria-current="page" href="/alumni">
                        @include('icons.user-icon')
                        <span class="item-name">Alumni</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('galeri*') ? 'active' : '' }}" aria-current="page" href="/galeri">
                        @include('icons.user-icon')
                        <span class="item-name">Galeri</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('biro*') ? 'active' : '' }}" aria-current="page" href="/biro">
                        @include('icons.user-icon')
                        <span class="item-name">Biro</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('prodi*') ? 'active' : '' }}" aria-current="page" href="/prodi">
                        @include('icons.user-icon')
                        <span class="item-name">Prodi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('fakultas*') ? 'active' : '' }}" aria-current="page" href="/fakultas">
                        @include('icons.user-icon')
                        <span class="item-name">Fakultas</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('kalender-akademik*') ? 'active' : '' }}" aria-current="page" href="/kalender-akademik">
                        @include('icons.user-icon')
                        <span class="item-name">Kalender Akademik</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('download*') ? 'active' : '' }}" aria-current="page" href="/download">
                        @include('icons.user-icon')
                        <span class="item-name">Download</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('buku-panduan*') ? 'active' : '' }}" aria-current="page" href="/buku-panduan">
                        @include('icons.user-icon')
                        <span class="item-name">Buku Panduan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('utilities*') ? 'active' : '' }}" aria-current="page" href="/utilities">
                        @include('icons.user-icon')
                        <span class="item-name">Utilities</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('contact*') ? 'active' : '' }}" aria-current="page" href="/contact">
                        @include('icons.user-icon')
                        <span class="item-name">Contact</span>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link {{ Request::is('kelas') ? 'active' : '' }}" aria-current="page" href="/kelas">
                        @include('icons.house-icon')
                        <span class="item-name">Kelas</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('tahunajaran') ? 'active' : '' }}" aria-current="page" href="/tahunajaran">
                        @include('icons.date-icon')
                        <span class="item-name">Tahun Ajaran</span>
                    </a>
                    <a class="nav-link {{ Request::is('reftagihan') ? 'active' : '' }}" aria-current="page" href="/reftagihan">
                        @include('icons.mark-icon')
                        <span class="item-name">Referensi Tagihan</span>
                    </a>
                </li>
                --}}
                
                
                
                {{-- <li>
                    <hr class="hr-horizontal">
                </li>
                <li class="nav-item static-item">
                    <a class="nav-link static-item disabled" href="#" tabindex="-1">
                        <span class="default-icon">Transaksi</span>
                        <span class="mini-icon">-</span>
                    </a>
                </li> --}}
{{--               
                <li class="nav-item">
                    <a class="nav-link collapsed " data-bs-toggle="collapse" href="#sidebar-maps" role="button" aria-expanded="false" aria-controls="sidebar-maps">
                        @include('icons.date-icon')
                        <span class="item-name">Manajemen Kelas</span>
                        <i class="right-icon">
                            <svg class="icon-18" xmlns="http://www.w3.org/2000/svg" width="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </i>
                    </a>
                    <ul class="sub-nav collapse" id="sidebar-maps" data-bs-parent="#sidebar-menu" style="">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('manajemenkelas') ? 'active' : '' }}" href="/manajemenkelas">
                                @include('icons.dot-icon')
                                <i class="sidenav-mini-icon"> G </i>
                                <span class="item-name">Siswa</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('daftarkelas') ? 'active' : '' }}" href="/daftarkelas">
                                @include('icons.dot-icon')
                                <i class="sidenav-mini-icon"> V </i>
                                <span class="item-name">Kelas</span>
                            </a>
                        </li>
                    </ul>
                </li> --}}
                {{-- <li class="nav-item">
                    <a class="nav-link {{ Request::is('tagihan') ? 'active' : '' }}" aria-current="page" href="/tagihan">
                        @include('icons.bill-icon')
                        <span class="item-name">Tagihan</span>
                    </a>
                </li> --}}
                <li>
                    <hr class="hr-horizontal">
                </li>
                
            </ul>
            <!-- Sidebar Menu End -->
        </div>
    </div>
    <div class="sidebar-footer"></div>
</aside>