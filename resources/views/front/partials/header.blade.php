  <!-- Header Start -->
  <div class="container-fluid header bg-white p-0">
            <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
                <div class="col-md-6 p-5 mt-lg-5">
					 @forelse($homeSliderBanners as $banner)
					 <h1 class="display-5 animated fadeIn mb-4">{{ $banner['title']}}</h1>
                    <p class="animated fadeIn mb-4 pb-2">{{ $banner['alt'] }}.</p>
					 @empty
                    <h1 class="display-5 animated fadeIn mb-4">Ayo Menikah <span class="text-primary">Di Gedung UNM</span> Dengan Harga Bersahabat</h1>
                    <p class="animated fadeIn mb-4 pb-2">Kami menyediakan Gedung Pernikahan dengan Kapasitas 2000 Undangan dengan fasilitas parkiran terluas se Kota Makassar.</p>
					 @endforelse
                    <a href="" class="btn btn-primary py-3 px-5 me-3 animated fadeIn">Booking</a>
                </div>
                <div class="col-md-6 animated fadeIn">
                    <div class="owl-carousel header-carousel">
                        @forelse($homeSliderBanners as $banner)
						
						@if($banner['image'] > 2)
                        <div class="owl-carousel-item">
                            <img class="img-fluid" src="{{ asset('front/images/banners/'. $banner['image'])}}" alt="">
							</div>
						@else
							<div class="owl-carousel-item">
							<img class="img-fluid" src="{{ asset('front/images/banners/'. $banner['image'])}}" alt="">
							</div>
							<div class="owl-carousel-item">
								<img class="img-fluid" src="{{url('front/img/carousel-1.jpg') }}" alt="">
							</div>
							<div class="owl-carousel-item">
								<img class="img-fluid" src="{{url('front/img/carousel-2.jpg') }}" alt="">
							</div>
						@endif
                        @empty
                        <div class="owl-carousel-item">
                            <img class="img-fluid" src="{{url('front/img/carousel-1.jpg') }}" alt="">
                        </div>
                        <div class="owl-carousel-item">
                            <img class="img-fluid" src="{{url('front/img/carousel-2.jpg') }}" alt="">
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
