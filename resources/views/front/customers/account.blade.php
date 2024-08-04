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
        <div class=" row g-0 gx-5">	
			@include('front.customers.sidebar_menu')
			<div class="col-8 col-md-8 col-sm-12 col-xs-12">
			<h5 class="text-white p-2 mb-4 bg-primary text-center" >Perbaharui Password</h5>
			  <form class="row g-3" action="{{ url('update-password') }}" method="post"> @csrf
			  <div class="col-md-6">
				<label for="inputEmail4" class="form-label">Email</label>
				<input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" readonly="">
			  </div>
			  <div class="col-md-6">
				<label for="inputPassword4" class="form-label">Kata Sandi Lama</label>
				<input type="text" class="form-control" id="current_pwd" name="current_pwd">
				<span class="text-danger" id="verifyCurrentPwd"></span>
			  </div>
			  <div class="col-md-6">
				<label for="inputPassword4" class="form-label">Kata Sandi Baru</label>
				<input type="password" class="form-control" name="new_pwd" id="new_pwd">
			  </div>
			  <div class="col-md-6">
				<label for="inputPassword4" class="form-label">Konfirmasi Kata Sandi Baru</label>
				<input type="password" class="form-control" name="confirm_pwd" id="confirm_pwd">
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