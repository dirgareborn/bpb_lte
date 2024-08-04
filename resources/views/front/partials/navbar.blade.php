<?php
$totalCartItems = totalCartItems();
?>

<!-- Navbar Start -->
<div class="container-fluid nav-bar bg-transparent">
    <nav class="navbar navbar-expand-lg bg-white navbar-light py-0 px-4">
        <a href="{{ route('beranda')}}" class="navbar-brand d-flex align-items-center text-center">
            <div class="icon p-2 me-2">
                <img class="img-fluid" src="{{url('logo.png') }}" alt="Icon" style="width: 30px; height: 30px;">
            </div>
            <h1 class="m-0 text-primary">BPB UNM</h1>
        </a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto">
                <a href="{{ route('beranda')}}" class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle {{ request()->is('visi-misi','struktur-organisasi','team') ? 'active' : '' }}" data-bs-toggle="dropdown">Profil</a>
                    <div class="dropdown-menu rounded-0 m-0">
                        <a href="{{url('visi-misi')}}" class="dropdown-item">Visi Misi</a>
                        <a href="{{url('struktur-organisasi')}}" class="dropdown-item">Struktur Organisasi</a>
                        <!-- <a href="{{url('team')}}" class="dropdown-item">Team</a> -->
                    </div>
                </div>
                <div class="nav-item dropdown" id="myDropdown">
                    <a href="#" class="nav-link dropdown-toggle {{ request()->is('layanan/*') ? 'active' : '' }}" data-bs-toggle="dropdown">Layanan</a>
                    <ul class="dropdown-menu rounded-0 m-0">
                        @foreach ($MenuCategories as $category)
                        <li><a class="dropdown-item" href="{{ url($category['url']) }}">{{ ucfirst($category['category_name']) }} @if(count($category['subcategories'])) &raquo;@endif</a></li>
                        @if(count($category['subcategories']))
                        <ul class="dropdown-menu">
                            @foreach ($category['subcategories'] as $subcategory)
                            <!-- <li class="nav-item dropend"><a class="dropdown-item">&raquo;&raquo;{{ ucfirst($subcategory['category_name']) }}</a></li> -->
                            @endforeach
                        </ul>
                        @endif
                        @endforeach
                    </ul>
                </div>
                <a href="{{ url('kontak-kami') }}" class="nav-item nav-link {{ request()->is('kontak-kami') ? 'active' : '' }}">Kontak</a>
                <a class="nav-item nav-link">|</a>
				@include('front.products.header_cart')
                @guest
                    @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="nav-item nav-link">Login</a>
                    @endif
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="nav-item nav-link">Daftar</a>
                    @endif
                    @else
                    <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                  <i class="fa fa-user"></i> 
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
									<a class="dropdown-item" href="{{ url('profil') }}">Profil</a>
									<a class="dropdown-item" href="{{ url('daftar-pesanan') }}">Daftar Pesanan</a>
                                </div>
                            </li>
                @endguest
            </div>
        </div>
    </nav>
</div>
<!-- Navbar End -->