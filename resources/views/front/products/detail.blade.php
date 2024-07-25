@extends('front.layouts.app')
@push('style')
<style>
    img {
  max-width: 100%; }

.preview {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -webkit-flex-direction: column;
      -ms-flex-direction: column;
          flex-direction: column; }
  @media screen and (max-width: 996px) {
    .preview {
      margin-bottom: 20px; } }

.preview-pic {
  -webkit-box-flex: 1;
  -webkit-flex-grow: 1;
      -ms-flex-positive: 1;
          flex-grow: 1; }

.preview-thumbnail.nav-tabs {
  border: none;
  margin-top: 15px; }
  .preview-thumbnail.nav-tabs li {
    width: 18%;
    margin-right: 2.5%; }
    .preview-thumbnail.nav-tabs li img {
      max-width: 100%;
      display: block; }
    .preview-thumbnail.nav-tabs li a {
      padding: 0;
      margin: 0; }
    .preview-thumbnail.nav-tabs li:last-of-type {
      margin-right: 0; }

.tab-content {
  overflow: hidden; }
  .tab-content img {
    width: 100%;
    -webkit-animation-name: opacity;
            animation-name: opacity;
    -webkit-animation-duration: .3s;
            animation-duration: .3s; }

.card {
  margin-top: 50px;
  background: #eee;
  padding: 3em;
  line-height: 1.5em; }

@media screen and (min-width: 997px) {
  .wrapper {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex; } }

.details {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -webkit-flex-direction: column;
      -ms-flex-direction: column;
          flex-direction: column; }

.colors {
  -webkit-box-flex: 1;
  -webkit-flex-grow: 1;
      -ms-flex-positive: 1;
          flex-grow: 1; }

.product-title, .price, .sizes, .colors {
  text-transform: UPPERCASE;
  font-weight: bold; }

.checked, .price span {
  color: #ff9f1a; }

.product-title, .rating, .product-description, .price, .vote, .sizes {
  margin-bottom: 15px; }

.product-title {
  margin-top: 0; }

.size {
  margin-right: 10px; }
  .size:first-of-type {
    margin-left: 40px; }

.color {
  display: inline-block;
  vertical-align: middle;
  margin-right: 10px;
  height: 2em;
  width: 2em;
  border-radius: 2px; }
  .color:first-of-type {
    margin-left: 20px; }

.add-to-cart, .like {
  background: #ff9f1a;
  padding: 1.2em 1.5em;
  border: none;
  text-transform: UPPERCASE;
  font-weight: bold;
  color: #fff;
  -webkit-transition: background .3s ease;
          transition: background .3s ease; }
  .add-to-cart:hover, .like:hover {
    background: #b36800;
    color: #fff; }

.not-available {
  text-align: center;
  line-height: 2em; }
  .not-available:before {
    font-family: fontawesome;
    content: "\f00d";
    color: #fff; }

.orange {
  background: #ff9f1a; }

.green {
  background: #85ad00; }

.blue {
  background: #0076ad; }

.tooltip-inner {
  padding: 1.3em; }

@-webkit-keyframes opacity {
  0% {
    opacity: 0;
    -webkit-transform: scale(3);
            transform: scale(3); }
  100% {
    opacity: 1;
    -webkit-transform: scale(1);
            transform: scale(1); } }

@keyframes opacity {
  0% {
    opacity: 0;
    -webkit-transform: scale(3);
            transform: scale(3); }
  100% {
    opacity: 1;
    -webkit-transform: scale(1);
            transform: scale(1); } }

/*# sourceMappingURL=style.css.map */
</style>
@endpush
@section('content')
<!-- Header Start -->
 
<div class="container-fluid header bg-white p-0">
    <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
        <div class="col-md-6 p-5 mt-lg-5">
             <br>
             <br>
             <br>
            <nav aria-label="breadcrumb animated fadeIn">
                <ol class="breadcrumb text-uppercase">
                    @for($i = 1; $i <= count(Request::segments()); $i++) <li class="breadcrumb-item"><a href="{{ URL::to( implode( '/', array_slice(Request::segments(), 0 ,$i, true)))}}">{{strtoupper(Request::segment($i))}}</a></li>
                        @endfor
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="container-xxl">
		<div class="card animated fadeIn">
			<div class="container">
				<div class="row g-5 wow fadeIn" data-wow-delay="0.1s"">
					<div class="preview col-md-6">
            		
						<div class="preview-pic tab-content" id="myTabContent">
            @foreach($productDetails['images'] as $key => $image) 
						  <div @if($key === 0) class="tab-pane fade show active" @else class="tab-pane" @endif id="pic-{{ $key }}"><img src="{{ asset('front/images/products/'. $productDetails['product_image']) }}" /></div>
              @endforeach
						</div>
						<ul class="preview-thumbnail nav nav-tabs" role="tablist">
            @foreach($productDetails['images'] as $key => $image)
						  <li @if($key === 0) class="active" @else class="" @endif><a data-bs-target="#pic-{{$key}}" data-bs-toggle="tab"><img src="{{ asset('front/images/products/galery/'. $image['image']) }}" /></a></li>
              @endforeach
						</ul>
					</div>
					<div class="details col-md-6">
						<h3 class="product-title">#1 {{ $productDetails['product_name']}}</h3>
						<div class="rating">
							<div class="stars">
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star"></span>
								<span class="fa fa-star"></span>
							</div>
							<span class="review-no">41 reviews</span>
						</div>
						<p class="product-description">{{ $productDetails['product_description'] }}</p>
						<h4 class="price">current price: <span>@currency($productDetails['product_price'])</span></h4>
						<p class="vote"><strong>91%</strong> of buyers enjoyed this product! <strong>(87 votes)</strong></p>
						<h5 class="sizes">Fasilitas : {!! $productDetails['product_facility'] !!}</h5>
                        <form action="https://api.whatsapp.com/send?phone=6285343704359?text={{$productDetails['product_name']}}" method="POST">
                        <!-- <form id="addToCart" name="addToCart" action="javascript:;"> -->
                        <!-- @csrf -->
                        <input type="hidden" name="product_id" value="{{$productDetails['id']}}">
                    <div class="row g-2">
                        <div class="col-md-10">
                            <div class="row g-2">
                                <div class="col-md-4">
                                    <input type="text" id="date_booking" name="date_booking" class="date form-control border-0 py-3" placeholder="Tanggal Penyewaan">
                                </div>
                                <div class="col-md-4">
                                  <select class="form-select border-0 py-3">
                                    <option selected>Jenis Penyewa</option>
                                    <option value="1">Civitas / Mahasiswa</option>
                                    <option value="2">Umum</option>
                                  </select>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="qty" id="qty" class="form-control border-0 py-3" placeholder="QTY">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="action">
                        <button class="btn btn-primary" type="submit">Add to Cart</button>
                        <button class="btn btn-dark" type="button"><span class="fa fa-heart"></span></button>
                    </div>
                </form>
                  <br>
                  <br>
                <div class="print-error-msg"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
    



@endsection

@push('scripts')
<script type="text/javascript">
    var array = ["05-07-2024", "08-07-2024", "17-07-2024", "21-07-2024"];

    $("input").datepicker({
        beforeShowDay: function(date) {
            var string = jQuery.datepicker.formatDate('dd-mm-yy', date);
            return [array.indexOf(string) == -1]
        }
    });
</script>
@endpush