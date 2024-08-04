@extends('front.layouts.app')
@push('style')

@endpush
@section('content')
@include('front.partials.header')
<div class="container-xl py-5">
    <div class="container">
	@if(Session::has('error_message'))
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<strong>Error:</strong> {{ Session::get('error_message') }}
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
		@endif
		@if(Session::has('success_message'))
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			<strong>Success : </strong> {{ Session::get('success_message') }}
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
		@endif
        <div class="row g-0 gx-5">	
			@include('front.customers.sidebar_menu')
			<div class="col-8 col-md-8 col-sm-12">
			<h5 class="text-white p-2 mb-4 bg-primary text-center" >Perbaharui Detail Profil</h5>
			  <form class="row g-3" method="post" action="{{ url('/update-detail') }}" enctype="multipart/form-data"> @csrf
				  <div class="form-group">
						<label for="Email">Email</label>
						<input type="email" class="form-control" id="email" name="email" value="{{ Auth::guard('web')->user()->email }}" readonly="">
					  </div>
				<div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" id="name" name="name" value="{{ Auth::guard('web')->user()->name ?? '' }}" class="form-control">
                    <span class="text-danger" id="verifyCurrentPwd"></span>
                  </div>
                  <div class="form-group">
                    <label for="handphone">No. Handphone</label>
                    <input type="text" name="mobile" id="mobile" value="{{ Auth::guard('web')->user()->mobile ?? '' }}" class="form-control">
                  </div>
				  <div class="form-group">
                    <label for="handphone">Alamat</label>
                    <input type="text" name="address" id="address" value="{{ Auth::guard('web')->user()->address ?? '' }}" class="form-control">
                  </div><div class="form-group">
                    <label for="handphone">Kode Pos</label>
                    <input type="text" name="pincode" id="pincode" value="{{ Auth::guard('web')->user()->pincode ?? '' }}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="handphone">Image</label>
                    <input type="file" name="image" id="image" value="{{ Auth::guard('web')->user()->image ?? '' }}" class="form-control">
                    <br>
                    @if(!empty(Auth::guard('web')->user()->image))
                    <a target="_blank" href="{{ url('front/images/customers/'.Auth::guard('web')->user()->image) }}" > Lihat Foto </a>
                    <input type="hidden"  name="current_image" value="{{ Auth::guard('web')->user()->image }}" class="form-control">
                    @endif
                </div>
				
			  <div class="col-12">
				<button type="submit" class="btn btn-primary">Update</button>
			  </div>
			</form>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
@endpush