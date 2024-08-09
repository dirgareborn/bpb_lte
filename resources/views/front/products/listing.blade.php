@extends('front.layouts.app')
@section('content')
<!-- Property List Start -->
<div class="container-fluid header bg-white p-0">
    <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
        <div class="col-md-6 p-5 mt-lg-5">
            <h1 class="display-5 animated fadeIn mb-4">{{$page_title}}</h1>
            <nav aria-label="breadcrumb animated fadeIn">
                <ol class="breadcrumb text-uppercase">
                    @for($i = 1; $i <= count(Request::segments()); $i++) <li class="breadcrumb-item"><a href="{{ URL::to( implode( '/', array_slice(Request::segments(), 0 ,$i, true)))}}">{{strtoupper(Request::segment($i))}}</a></li>
                        @endfor
                </ol>
            </nav>
        </div>
        <div class="col-md-6 animated fadeIn">
            <img class="img-fluid" src="{{ asset('front/img/header.jpg') }}" alt="">
        </div>
    </div>
</div>
@include('front.partials.search')
<div class="container-xxl py-5">
    <div class="container">
        <div class="tab-content">
            <div id="tab-1" class="tab-pane fade show p-0 active">
                <div class="row g-4">
                    @foreach($categoryProducts as $product)
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="property-item rounded overflow-hidden">
                            <div class="position-relative overflow-hidden">
                                @if(isset($product['images'][0]['image']) && !empty($product['images'][0]['image']))
                                <a href=""><img class="img-fluid" src="{{ asset('front/images/products/'.$product['product_image'])}}" alt=""></a>
                                @else
                                <a href=""><img class="img-fluid" src="front/img/property-1.jpg" alt=""></a>
                                @endif
                                <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">Di Sewakan</div>
                                <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">{{ $product['categories']['category_name'] }}</div>

                            </div>
                            <div class="p-4 pb-0">
                                <h5 class="text-primary mb-3">@currency($product['product_price'])</h5>
                                <a class="d-block h5 mb-2" href="{{url('produk/'. $product['url'])}}">{{ $product['product_name']}}</a>
                                <p><i class="fa fa-map-marker-alt text-primary me-2"></i> <a target="_blank" href="{{ $product['locations']['maps']}}">{{ $product['locations']['name'] }}</a></p>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <!--  <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                                <a class="btn btn-primary py-3 px-5" href="">Browse More Property</a>
                            </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
        <!-- Property List End -->
        @endsection