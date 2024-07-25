@extends('front.layouts.app')
@section('content')
 <!-- Header Start -->
 <div class="container-fluid header bg-white p-0">
            <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
                <div class="col-md-6 p-5 mt-lg-5">
                    <h1 class="display-5 animated fadeIn mb-4">{{$page_title}}</h1> 
                        <nav aria-label="breadcrumb animated fadeIn">
                        <ol class="breadcrumb text-uppercase">
                        @for($i = 1; $i <= count(Request::segments()); $i++)
                            <li class="breadcrumb-item"><a href="{{ URL::to( implode( '/', array_slice(Request::segments(), 0 ,$i, true)))}}">{{strtoupper(Request::segment($i))}}</a></li>
                        @endfor
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 animated fadeIn">
                    <img class="img-fluid" src="{{ asset('web/img/header.jpg') }}" alt="">
                </div>
            </div>
        </div>
        <!-- Header End -->
        <!-- Search Start -->
        @include('front.partials.search')
        <!-- Search End -->
        <!-- Property List Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-0 gx-5 align-items-end">
                    <div class="col-lg-6">
                        <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
                            <h1 class="mb-3">{{$page_title}}</h1>
                            <p>{{$page_description }}</p>
                        </div>
                    </div>
                    <div class="col-lg-6 text-start text-lg-end wow slideInRight" data-wow-delay="0.1s">
                        <ul class="nav nav-pills d-inline-flex justify-content-end mb-5">
                            <li class="nav-item me-2">
                                <a class="btn btn-outline-primary active" data-bs-toggle="pill" href="#tab-1">Featured</a>
                            </li>
                            <li class="nav-item me-2">
                                <a class="btn btn-outline-primary" data-bs-toggle="pill" href="#tab-2">For Sell</a>
                            </li>
                            <li class="nav-item me-0">
                                <a class="btn btn-outline-primary" data-bs-toggle="pill" href="#tab-3">For Rent</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            @if(count($layanans) > 0)
                            @foreach($layanans as $layanan)
                            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href=""><img class="img-fluid" src="{{ asset('front/images/products/'. $layanan->product_image) }}" alt="" ></a>
                                        <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">For Rent</div>
                                        <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">{{ $layanan->product_name }}</div>
                                    </div>
                                    <div class="p-4 pb-0">
                                        <h5 class="text-primary mb-3">@currency($layanan->product_price)</h5>
                                        <a class="d-block h5 mb-2" href="{{ route('layanan.kategori.detail',['kategori' => $kategoriLayanan->url, 'produk' => $layanan->url]) }}">{{ $layanan->product_name }}</a>
                                        <p><i class="fa fa-map-marker-alt text-primary me-2"></i>{{ $layanan->locations->name }}</p>
                                    </div>
                                    <!-- <div class="d-flex border-top">
                                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-ruler-combined text-primary me-2"></i>1000 Sqft</small>
                                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-bed text-primary me-2"></i>3 Bed</small>
                                        <small class="flex-fill text-center py-2"><i class="fa fa-bath text-primary me-2"></i>{{ $layanan->status }}</small>
                                    </div> -->
                                </div>
                            </div>
                                    @endforeach
                                    @else
                                    <h4 class="text-center"><span class="fa fa-times"></span> Data tidak ditemukan.</h4>
                                    @endif
                        </div>
                        {{ $layanans->links()}}
                    </div>
                </div>
            </div>
        </div>
        <!-- Property List End -->
@endsection