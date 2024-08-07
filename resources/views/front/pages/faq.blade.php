@extends('front.layouts.app')
@section('content')
 <!-- Header Start -->
 <div class="container-fluid header bg-white p-0">
            <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
                <div class="col-md-6 p-5 mt-1">
                    <h3 class="display-9 animated fadeIn mb-4">{{$page_title}}</h3> 
                        <nav aria-label="breadcrumb animated fadeIn">
                        <ol class="breadcrumb text-uppercase">
                        @for($i = 1; $i <= count(Request::segments()); $i++)
                            <li class="breadcrumb-item"><a href="{{ URL::to( implode( '/', array_slice(Request::segments(), 0 ,$i, true)))}}">{{strtoupper(Request::segment($i))}}</a></li>
                        @endfor
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 animated fadeIn">
                    <img class="img-fluid" src="{{ asset('front/img/header.jpg') }}" alt="">
                </div>
            </div>
        </div>
        <!-- Header End -->
        @include('front.partials.search')
        <div class="container-xxl py-5">
            <div class="container">
						<h1 class="display-5 animated fadeIn mb-4">{{$page_title}}</h1> 
                        <div class="row g-0 text-center">
                        <div class="col-lg-12 wow fadeIn" data-wow-delay="0.5s">
                            <div class="accordion" id="accordionExample">
							  <div class="accordion-item">
								<h2 class="accordion-header" id="headingOne">
								  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									Accordion Item #1
								  </button>
								</h2>
								<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
								  <div class="accordion-body">
									<strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
								  </div>
								</div>
							  </div>
							  <div class="accordion-item">
								<h2 class="accordion-header" id="headingTwo">
								  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
									Accordion Item #2
								  </button>
								</h2>
								<div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
								  <div class="accordion-body">
									<strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
								  </div>
								</div>
							  </div>
							  <div class="accordion-item">
								<h2 class="accordion-header" id="headingThree">
								  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
									Accordion Item #3
								  </button>
								</h2>
								<div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
								  <div class="accordion-body">
									<strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
								  </div>
								</div>
							  </div>
							</div>				
                        </div>
                        </div>
                    </div>
                </div>
@endsection
       