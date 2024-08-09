@extends('front.layouts.app')

@section('content')
        <!-- Property List Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-0 gx-5 align-items-end">
                    <div class="col-lg-6">
                        <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
                            <h1 class="mb-3">LAYANAN</h1>
                            <!-- <p>Eirmod sed ipsum dolor sit rebum labore magna erat. Tempor ut dolore lorem kasd vero ipsum sit eirmod sit diam justo sed rebum.</p> -->
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            @foreach($products as $product)
                            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        @if(isset($product['images'][0]['image']) && !empty($product['images'][0]['image']))
                                        <a href=""><img class="img-fluid" src="{{ asset('front/images/products/'.$product['product_image'])}}" alt=""></a>
                                        @else
                                        <a href=""><img class="img-fluid" src="front/img/property-1.jpg" alt=""></a>
                                        @endif
                                        <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3"></div>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Property List End -->
@endsection