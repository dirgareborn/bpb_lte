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
                <!-- <a href="Profil" class="nav-item nav-link {{ request()->is('/informasi') ? 'active' : '' }}">Informasi</a> -->
                <a href="{{ url('kontak-kami') }}" class="nav-item nav-link {{ request()->is('kontak-kami') ? 'active' : '' }}">Kontak</a>
                <a href="{{ url('login') }}" class="nav-item nav-link {{ request()->is('login') ? 'active' : '' }}">Login</a>
                <a href="{{ url('cart') }}" class="nav-item nav-link {{ request()->is('cart') ? 'active' : '' }}"></a>

                <!-- <i class="fas fa-shopping-cart "></i>
                <span class="badge bg-danger" style="margin-top:-55px; width: 30px; height: 30px; font-size: 15px; border-radius: 15px;
                            transform: perspective(0px) translate(-12px) rotate(0deg) scale(0.50);transform-origin: top;;text-align: center;border-width: 30px;">
                    {{ $totalCartItems }}
                </span> -->
                @include('front.products.header_cart')
                @if (Route::has('login'))
                @auth
                <a href="{{ url('/dashboard') }}" class="btn btn-primary px-3 d-none d-lg-flex">Dashboard</a>
                @else
                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn btn-primary px-3 d-none d-lg-flex">Register</a>
                @endif
                @endauth
                @endif
            </div>
        </div>
    </nav>
</div>
<!-- Navbar End -->