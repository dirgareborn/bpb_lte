<?php

use App\Models\Product; ?>
@extends('front.layouts.app')
@push('style')
<link rel="stylesheet" href="{{ url('admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
@endpush
@section('content')
<div class="container">
    <main>
        <div class="container-fluid py-5 text-center">
            <img class="d-block mx-auto mb-4" src="/logo.webp" alt="" width="72" height="72">
            <h2>Formulir Pembayaran</h2>
            <p class="lead">
Sebelum Bapak/Ibu Melakukan pembayaran, Pastikan semua data yang diinput sudah benar! </p>
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
            </div>
            <div class="col-md-6 col-lg-6">
                <h4 class="mb-3">Data Penagihan</h4>
                <form class="needs-validation" action="{{url('/checkout')}}" method="POST" novalidate> @csrf
                    <div class="row g-3">

                        <div class="col-12">
                            <label for="Nama" class="form-label">Nama</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text">@</span>
                                <input type="text" class="form-control" id="Nama" name="name" placeholder="Name" Value="{{ Auth::user()->name ?? '' }}" required>
                                <div class="invalid-feedback">
                                    Your username is required.
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" placeholder="Jl. Raya Pendidikan No. 1" name="address" required Value="{{ Auth::user()->address ?? '' }}">
                            <div class="invalid-feedback">
                                Please enter your shipping alamat.
                            </div>
                        </div>
						
                        <div class="col-4">
                            <label for="email" class="form-label">Email <span class="text-muted">(Optional)</span></label>
                            <input type="email" class="form-control" id="email" placeholder="customer@mallbisnisunm.com" name="email" Value="{{ Auth::user()->email ?? '' }}">
                            <div class="invalid-feedback">
                                Please enter a valid email address for shipping updates.
                            </div>
                        </div>
                        <div class="col-4">
                            <label for="mobile" class="form-label">No. Handpone</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text">+62</span>
                                <input type="text" class="form-control" name="mobile" id="mobile" placeholder="81234567" Value="{{ Auth::user()->mobile ?? '' }}" required>
                                <div class="invalid-feedback">
                                    Your username is required.
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="pincode" class="form-label">Kode Pin</label>
                            <input type="text" class="form-control" id="pincode" name="pincode" placeholder="" Value="{{ Auth::user()->pincode ?? '' }}" >
                            <div class="invalid-feedback">
                                Zip code required.
                            </div>
                        </div>
                    </div>
					<hr class="my-4">
					   <div class="form-check">
						<input type="checkbox" class="form-check-input" name="agree" id="save-info">
						<label class="form-check-label" for="save-info"> Setujui Untuk Melanjutkan Pembayaran</label>
					  </div>

                    <hr class="my-4">
                    <h4 class="mb-3">Pembayaran</h4>
                    <div class="my-3">
                        <div class="form-check">
                            <input id="cash" name="payment_gateway" type="radio" class="form-check-input" value="cash" checked required>
                            <label class="form-check-label" for="payment_gateway">Cash</label><br>
                            <small class="text-muted"> (Silahkan selesaikan pembayaran maksimal 1 hari setelah booking )</small>
                        </div>
                        <div class="form-check">
                            <input id="transfer" value="transfer" name="payment_gateway" type="radio" class="form-check-input" required>
                            <label class="form-check-label" for="debit">Transfer Bank</label><br>
                            <small class="text-muted"> (lakukan pembayaran langsung ke rekening bank kami, silakan gunakan kode id pesanan Anda sebagai referensi pembayaran )</small>
                        </div>
                    </div>
                    <hr class="my-4">
                    <button class="w-100 btn btn-primary btn-lg" type="submit" id="pay-button">Lanjut Ke Pembayaran</button>
                </form>
            </div>
        </div>
    </main>
</div>
@php $snap_token =0; @endphp 
@if(isset($order->snap_token) > 0) {{$snap_token=$order->snap_token }} @else {{ $snap_token ="" }} @endif
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.12.2/sweetalert2.min.js" integrity="sha512-JWPRTDebuCWNZTZP+EGSgPnO1zH4iie+/gEhIsuotQ2PCNxNiMfNLl97zPNjDVuLi9UWOj82DEtZFJnuOdiwZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY')}}"></script>
 <script type="text/javascript">
      document.getElementById('pay-button').onclick = function(){
        // SnapToken acquired from previous step
        snap.pay('{{ $snap_token }}', {
          // Optional
          onSuccess: function(result){
            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          },
          // Optional
          onPending: function(result){
            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          },
          // Optional
          onError: function(result){
            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          }
        });
      };
    </script>
@endpush