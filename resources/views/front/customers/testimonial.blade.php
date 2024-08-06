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
			  <form class="row g-3" action="{{ url('testimonial') }}" method="post"> @csrf
			  <div class="col-md-12">
                <div class="form-group">

                    <label for="description" class="form-label">Testimonial</label>

                    <textarea name="description" class="form-control" id="description" rows="5"> {{ $getTestimonial->description ?? ''}}</textarea>

                </div>
			  </div>
			  <div class="col-md-12">
				<button type="submit" class="btn btn-primary">Simpan</button>
			  </div>
			</form>
			</div>
		</div>
	</div>
</div>
@endsection