@extends('front.layouts.app')
@push('style')
<style>
    img {
  max-width: 100%; }

.preview {
@media (min-width:320px)  {  
.card {
	padding: 1em;
margin:10px 10px;
}
 }
@media (min-width:480px)  { 
.card {
	padding: 1em;
margin:10px 10px;}
 }
 }
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
  margin:10px 50px;
  background: #22222;
  padding: 0em;
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
            transform: scale(1); } 
}

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

<div >
	<div class="card rounded-0 border-0 animated fadeIn">
		<div class="row g-5 wow fadeIn" data-wow-delay="0.1s"">
			<div class="col-md-6 preview">
				<div class="preview-pic tab-content" id="myTabContent">
					@foreach($productDetails['images'] as $key => $image) 
					<div @if($key == 0) class="tab-pane fade show active" @else class="tab-pane" @endif id="pic-{{ $key }}">
						<img @if($key == 0) src="{{ asset('front/images/products/'. $productDetails['product_image']) }}" @else src="{{ asset('front/images/products/galery/'. $image['image']) }}" @endif/></div>
					@endforeach
					</div>
					<ul class="preview-thumbnail nav nav-tabs" role="tablist">
					@foreach($productDetails['images'] as $key => $image)
					    <li @if($key == 0) class="active" @else class="" @endif>
						  <a data-bs-target="#pic-{{$key}}" data-bs-toggle="tab">
						  <img @if($key == 0) src="{{ asset('front/images/products/'. $productDetails['product_image']) }}" @else src="{{ asset('front/images/products/galery/'. $image['image']) }}" @endif/>
						  </a>
						 </li>
					@endforeach
					</ul>
		</div>
		<div class="details col-md-6">
			<h3 class="product-title">#1 {{ $productDetails['product_name'] }}</h3>
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
				<h5 class="price">Harga: <span> @currency($productDetails['final_price'])</span></h5>
						  @if($productDetails['discount_type']!="") <br>
							Diskon {{ $productDetails['product_discount']}} % 
						  <del>@currency($productDetails['product_price'])</del>
						  @endif
				<p class="vote"><strong>91%</strong> of buyers enjoyed this product! <strong>(87 votes)</strong></p>
				<p class="sizes">Fasilitas : {!! $productDetails['product_facility'] !!}</p>
                <form id="addToCart" name="addToCart" action="javascript:;" method="POST">
                        <!-- @csrf -->
                <input type="hidden" name="product_id" value="{{$productDetails['id']}}">
                    <div class="row g-2">
                        <div class="col-md-10">
                            <div class="row g-2">
                                <div class="col-md-4">
                                    <input  id="start" name="start" class="date form-control py-3" placeholder="Mulai Tanggal ">
                                </div>
								<div class="col-md-4">
                                    <input id="end" name="end" class="date form-control  py-3" placeholder="Sampai Tanggal">
                                </div>
                                <div class="col-md-4">
                                  <select name="customer_type" class="form-select py-3">
                                    <option selected value="umum">Penyewa</option>
                                    <option value="umum">Umum</option>
                                    <option value="civitas">Civitas</option>
                                    <option value="mahasiswa">Mahasiswa</option>
                                  </select>
                                </div>
                               <!-- <div class="col-md-0">
                                    <input type="hidden" name="qty" id="qty" class="form-control border-0 py-3" value="1" placeholder="QTY">
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="action">
                        <button class="btn btn-primary" type="submit">Masukkan Keranjang</button>
                        <button class="btn btn-dark" type="button"><span class="fa fa-heart"></span></button>
                    </div>
                </form>
                <div class="print-error-msg"></div>
				<div class="print-success-msg"></div>
			</div>
		</div>
</div>
</div>
    
@endsection

@push('scripts')
<script type="text/javascript">
    var array = ["05-08-2024", "08-08-2024", "17-08-2024", "21-07-2024"];
    $("input").datepicker({
        beforeShowDay: function(date) {
            var string = jQuery.datepicker.formatDate('dd-mm-yy', date);
            return [array.indexOf(string) == -1]
        }
    });
</script>
@endpush