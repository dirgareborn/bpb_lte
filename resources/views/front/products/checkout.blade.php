<?php

use App\Models\Product; ?>
@extends('front.layouts.app')
@push('style')
<link rel="stylesheet" href="{{ url('admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
@endpush
@section('content')
<div class="container">
    <main>
        <div class="container-xxl py-5 text-center">
            <img class="d-block mx-auto mb-4" src="/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
            <h2>Formulir Checkout</h2>
            <p class="lead">
                Below is an example form built entirely with Bootstrap’s form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.
            </p>
        </div>

        <div class="row g-5">
        @include('admin.partials.alert') 
           
            <div class="col-md-6 col-lg-6 order-md-last">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-primary">Keranjang Anda</span>
                    <span class="badge bg-primary rounded-pill"> {{ $totalCartItems ?? ''}} </span>
                </h4>
                <ul class="list-group mb-3">
                @php $total_price = 0 @endphp
                    @foreach($getCartItems as $item)
                    <?php 
                    $getAttributePrice = Product::getAttributePrice($item['product_id'],$item['customer_type']); ?>
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0">Nama Produk</h6>
                            <small class="text-muted">{{ $item['product']['product_name']}}</small>
                        </div>
                        
                        <span class="text-muted">
                                @if($getAttributePrice['discount']>0) 
                                Diskon {{ $getAttributePrice['discount_percent'] }} % Dari
                                <del>@currency($getAttributePrice['product_price']* $item['qty'])</del>
                                @endif
                        @currency($getAttributePrice['final_price'] * $item['qty'])
                        </span>
                        <div>
                            <a class="confirmDelete" name="{{ $item['product']['product_name'] }}" href="javascript:void(0)" record="cart-item" recordid="{{ $item['id'] }}" title="Hapus Produk"> <i class="fas fa-trash text-danger"></i> </a>
                        </div>
                    </li>
                    @php $total_price = $total_price + ($getAttributePrice['final_price'] * $item['qty']);
						$cart_id = $item['id'];
						$item_id = $item['product_id'];
						$item_name = $item['product']['product_name'];
						$item_tgl = $item['start_date'];
                    @endphp
                    @endforeach
                    <li class="list-group-item d-flex justify-content-between">
                    Total<strong> @currency($total_price)</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                    Subsidi (Diskon)  <strong class="couponAmount">
                        
                                @if(Session::has('couponAmount')) 
                                    @currency(Session::get('couponAmount'))
                                    @else Rp.0 
                                @endif
                        </strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                    Grand Total <strong class="grandTotal">
                                @if(Session::has('grandTotal')) 
                                    @currency(Session::get('grandTotal'))
                                    @else @currency($total_price)
                                @endif
                            </strong> 
                    </li>
                </ul>
                <div class="alert alert-danger" style="display: none;"></div>
                    <div class="alert alert-success"  style="display: none;"></div>
                <form class="card p-2" action="javascript:;">
                    <div class="input-group">
                        <input type="text" class="form-control" id="code" name="coupon_code" placeholder="Kode Subsidi / Diskon">
                        <button @if(Auth::check()) user="1" @endif type="submit" id="ApplyCoupon" class="btn btn-secondary">Pakai</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6 col-lg-6">
                <h4 class="mb-3">Data Penagihan</h4>
                <form class="needs-validation" action="{{url('/checkout')}}" method="POST" novalidate> @csrf
                    <div class="row g-3">

                        <div class="col-12">
                            <label for="Nama" class="form-label">Nama</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text">@</span>
                                <input type="text" class="form-control" id="Nama" placeholder="Nama" required>
                                <div class="invalid-feedback">
                                    Your username is required.
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" placeholder="1234 Main St" required>
                            <div class="invalid-feedback">
                                Please enter your shipping alamat.
                            </div>
                        </div>

                        <div class="col-4">
                            <label for="email" class="form-label">Email <span class="text-muted">(Optional)</span></label>
                            <input type="email" class="form-control" id="email" placeholder="customer@mallbisnisunm.com">
                            <div class="invalid-feedback">
                                Please enter a valid email address for shipping updates.
                            </div>
                        </div>
                        <div class="col-4">
                            <label for="email" class="form-label">No. Handphone <span class="text-muted">(Optional)</span></label>
                            <input type="email" class="form-control" id="email" placeholder="you@example.com">
                            <div class="invalid-feedback">
                                Please enter a valid email address for shipping updates.
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="pincode" class="form-label">Pincode</label>
                            <input type="text" class="form-control" id="pincode" placeholder="" required>
                            <div class="invalid-feedback">
                                Zip code required.
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <h4 class="mb-3">Pembayaran</h4>
                    <div class="my-3">
                        <div class="form-check">
                            <input id="cash" name="payment_method" type="radio" class="form-check-input" value="cash" checked required>
                            <label class="form-check-label" for="payment_method">Cash</label><br>
                            <small class="text-muted"> (Silahkan selesaikan pembayaran maksimal 1 hari setelah booking )</small>
                        </div>
                        <div class="form-check">
                            <input id="transfer" value="transfer" name="payment_method" type="radio" class="form-check-input" required>
                            <label class="form-check-label" for="debit">Transfer Bank</label><br>
                            <small class="text-muted"> (lakukan pembayaran langsung ke rekening bank kami, silakan gunakan kode id pesanan Anda sebagai referensi pembayaran )</small>
                        </div>
                    </div>

                    <!-- <div class="row gy-3">
                        <div class="col-md-6" style="display:none;" id="paymentField">
                            <label for="cc-name" class="form-label">Name on card</label>
                            <input type="text" class="form-control" id="cc-name" placeholder="" required>
                            <small class="text-muted">Full name as displayed on card</small>
                            <div class="invalid-feedback">
                                Name on card is required
                            </div>
                        </div> -->

                        <!-- <div class="col-md-6" style="display:none;" id="paymentField">
                            <label for="cc-number" class="form-label">Nomor Rekening</label>
                            <input type="text" class="form-control" id="cc-number" placeholder="" required>
                            <div class="invalid-feedback">
                                Credit card number is required
                            </div>
                        </div> -->

                        <!-- <div class="col-md-3">
                            <label for="cc-expiration" class="form-label">Expiration</label>
                            <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                            <div class="invalid-feedback">
                                Expiration date required
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="cc-cvv" class="form-label">CVV</label>
                            <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                            <div class="invalid-feedback">
                                Security code required
                            </div>
                        </div> -->
                    <!-- </div> -->

                    <hr class="my-4">

                    <button class="w-100 btn btn-primary btn-lg" type="submit">Lanjut Ke Pembayaran</button>
                </form>
            </div>
        </div>
    </main>
</div>
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.12.2/sweetalert2.min.js" integrity="sha512-JWPRTDebuCWNZTZP+EGSgPnO1zH4iie+/gEhIsuotQ2PCNxNiMfNLl97zPNjDVuLi9UWOj82DEtZFJnuOdiwZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush