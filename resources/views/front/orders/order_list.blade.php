@extends('front.layouts.app')
@push('style')
<style>

.dot {
height: 10px;
width: 10px;
margin-left: 3px;
margin-right: 3px;
margin-top: 0px;
background-color: #488978;
border-radius: 50%;
display: inline-block
}

.big-dot {
height: 15px;
width: 15px;
margin-left: 0px;
margin-right: 0px;
margin-top: 0px;
background-color: #488978;
border-radius: 50%;
display: inline-block;
}

.big-dot i {
font-size: 8px;
}

</style>
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
			
			@include('front.orders.order_list_item')
			
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
@endpush