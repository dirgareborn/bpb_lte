  <div class="col-4 col-md-4 col-sm-12">
  <h5 class="text-white p-2 mb-4 bg-primary text-center">Halo {{ Auth::user()->name }}</h5>
    <ul class="list-group">
	  <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ request()->is('profil') ? 'bg-primary ' : '' }}">
		<a class="nav-link {{ request()->is('profil') ? 'text-white ' : '' }}" href="{{ url('/profil') }}">
		Profil
		</a>
	  </li>
	  <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ request()->is('account') ? 'bg-primary ' : '' }}">
		<a class="nav-link {{ request()->is('account') ? 'text-white ' : '' }}" href="{{ url('/account') }}">
		Update Password
		</a>
	  </li>
	  <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ request()->is('daftar-pesanan') ? 'bg-primary ' : '' }}">
		<a class="nav-link {{ request()->is('daftar-pesanan') ? 'text-white ' : '' }}" href="{{ url('/daftar-pesanan') }}">
		Daftar Pesanan
		</a>
		<span class="badge bg-primary rounded-pill">2</span>
	  </li>
	</ul>
 &nbsp;
 </div>
 
