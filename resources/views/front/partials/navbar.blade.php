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
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle {{ request()->is('layanan/*') ? 'active' : '' }}" data-bs-toggle="dropdown">Layanan</a>
                            <div class="dropdown-menu rounded-0 m-0">
                            @foreach ($MenuCategories as $category)
                            <a class="dropdown-item" href="{{ url($category['url']) }}">{{ ucfirst($category['category_name']) }}</a>
                                @if(count($category['subcategories']))
                                    @foreach ($category['subcategories'] as $subcategory)
                                    <a href="" class="dropdown-toggle">{{ ucfirst($subcategory['category_name']) }}</a>
                                    @endforeach
                                @endif
                            @endforeach
                            </div>
                        </div>
                        <!-- <a href="Profil" class="nav-item nav-link {{ request()->is('/informasi') ? 'active' : '' }}">Informasi</a> -->
                        <a href="{{ url('kontak') }}" class="nav-item nav-link {{ request()->is('kontak') ? 'active' : '' }}">Kontak</a>
                        <!-- <a href="{{ url('login') }}" class="nav-item nav-link {{ request()->is('login') ? 'active' : '' }}">Login</a> -->
                    </div>
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
            </nav>
        </div>
        <!-- Navbar End -->