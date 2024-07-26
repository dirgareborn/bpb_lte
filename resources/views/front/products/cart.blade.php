<?php use App\Models\Product; ?>
@extends('front.layouts.app')
@push('style')
<link rel="stylesheet" href="{{ url('admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
@endpush
@section('content')
<!-- Property List Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-10">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-normal mb-0">Keranjang Belanja</h3>
                    <div>
                        <p class="mb-0"><span class="text-muted">Sort by:</span> <a href="#!" class="text-body">Harga <i class="fas fa-angle-down mt-1"></i></a></p>
                    </div>
                </div>

                <div class="card rounded-3 mb-4">
                    @php $total_price = 0 @endphp
                    @foreach($getCartItems as $item)
                    <?php 
                    $getAttributePrice = Product::getAttributePrice($item['product_id'],$item['customer_type']);
                    
                    ?>
                    <div class="card-body p-4">
                        <div class="row d-flex justify-content-between align-items-center">
                            <div class="col-md-2 col-lg-2 col-xl-2">
                                <img src="{{ asset('front/images/products/'. $item['product']['product_image']) }}" class="img-fluid rounded-3" alt="Image">
                            </div>
                            <div class="col-md-3 col-lg-3 col-xl-3">
                                <p class="lead fw-normal mb-2">{{ $item['product']['product_name']}}</p>
                                <!-- <p><span class="text-muted">Kategori: {{ $item['product']['product_name']}}</span></p> -->
                            </div>
                            <div class="col-md-2 col-lg-2 col-xl-2 d-flex">
                            <p class="lead fw-normal mb-2">{{ \Carbon\Carbon::parse($item['start_date'])->format('d/M/Y') }}</p>
                            </div>
                            <!-- <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                <button data-mdb-button-init data-mdb-ripple-init class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                    <i class="fas fa-minus"></i>
                                </button>

                                <input id="form1" min="0" name="quantity" value="2" type="number" class="form-control form-control-sm" />

                                <button data-mdb-button-init data-mdb-ripple-init class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div> -->
                            <div class="col-md-4 col-lg-4 col-xl-3 offset-lg-1">

                            <hp class="mb-0 price">Harga: <span> @currency($getAttributePrice['final_price'])</span></p>
                                @if($getAttributePrice['discount']>0) 
                                Diskon {{ $getAttributePrice['discount_percent'] }} % 
                                <del>@currency($getAttributePrice['product_price'])</del>
                                @endif

                            </div>
                            <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                            <a class="confirmDelete" name="{{ $item['product']['product_name'] }}" href="javascript:void(0)" record="cart-item" recordid="{{ $item['id'] }}" title="Hapus Produk"> <i class="fas fa-trash text-danger"></i> </a>
                        
                            </div>
                        </div>
                    </div>
                    @php $total_price = $total_price + ($getAttributePrice['final_price'] * $item['qty']) @endphp
                    @endforeach
                </div>
                <div class="card mb-4">
                    <div class="card-body p-4 d-flex flex-row">
                        <div data-mdb-input-init class="form-outline flex-fill">
                            <!-- <input type="text" id="form1" class="form-control form-control-lg" /> -->
                            <h6 class="form-label float-end">Total @currency($total_price)</h6> 
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-body">
                        <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-warning btn-block btn-lg float-end">Proses Pembayaran</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Property List End -->
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.12.2/sweetalert2.min.js" integrity="sha512-JWPRTDebuCWNZTZP+EGSgPnO1zH4iie+/gEhIsuotQ2PCNxNiMfNLl97zPNjDVuLi9UWOj82DEtZFJnuOdiwZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@endpush