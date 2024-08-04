
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-11">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-normal mb-0">Keranjang Belanja</h3>
                    <div>
                        <p class="mb-0"><span class="text-muted">Sort by:</span> <a href="#!" class="text-body">Harga <i class="fas fa-angle-down mt-1"></i></a></p>
                    </div>
                </div>

                <div class="card rounded-3 mb-6">
				<?php use App\Models\Product; ?>
                    @php $total_price = 0 @endphp
                    @foreach($getCartItems as $item)
                    <?php 
                    $getAttributePrice = Product::getAttributePrice($item['product_id'],$item['customer_type']);
                    
                    ?>
                    <div class="card-body">
                        <div class="row d-flex justify-content-between align-items-center">
                            <div class="col-md-2 col-lg-2 col-xl-2">
                                <img src="{{ asset('front/images/products/'. $item['product']['product_image']) }}" class="img-fluid rounded-3" alt="Image">
                            </div>
                            <div class="col-md-2 col-lg-2 col-xl-2">
                                <p class="lead fw-normal mb-2">{{ $item['product']['product_name']}}</p>
                                <small><span class="text-muted">Kategori: {{ $item['product']['categories']['category_name']}}</span></small>
                            </div>
                            <div class="col-md-2 col-lg-2 col-xl-2 d-flex">
                            <p class="lead fw-normal">{{ format_date($item['start_date']) }}</p>
                            </div>
                            <div class="col-md-2 col-lg-2 col-xl-2 offset-lg-2">
                            <p class="mb-0 price">Harga: <span> @currency($getAttributePrice['final_price'] * $item['qty'])</span></p>
                                
                            @if($getAttributePrice['discount']>0) 
                                Diskon {{ $getAttributePrice['discount_percent'] }} % Dari
                                <del>@currency($getAttributePrice['product_price']* $item['qty'])</del>
                                @endif

                            </div>
                            <div class="col-md-2 col-lg-2 col-xl-2 text-center">
                            <a class="confirmDelete btn btn-danger" name="{{ $item['product']['product_name'] }}" href="javascript:void(0)" record="cart-item" recordid="{{ $item['id'] }}" title="Hapus Produk"> Hapus</a>
							</div>
                        </div>
                    </div>
                    @php $total_price = $total_price + ($getAttributePrice['final_price'] * $item['qty']);
						 $cart_id = $item['id'];
						 $item_id = $item['product_id'];
						 $item_name = $item['product']['product_name'];
						 $item_tgl = $item['start_date'];
					@endphp
					
                    @endforeach
                </div>
                <div class="row">
                <div class="col-md-6">
                    <div class="card-body p-4 d-flex flex-row">
                        <div data-mdb-input-init class="form-outline flex-fill">
                            <h6 class="form-labelfloat-end">Total @currency($total_price)</h6> 
							Subsidi (Diskon)  <strong class="couponAmount">
                                @if(Session::has('couponAmount')) 
                                    @currency(Session::get('couponAmount'))
                                    @else Rp.0 
                                @endif
                        </strong>
							Grand Total <strong class="grandTotal">
                                @if(Session::has('grandTotal')) 
                                    @currency(Session::get('grandTotal'))
                                    @else @currency($total_price)
                                @endif
                            </strong> 
                        </div>
                    </div>
                </div>
				<div class="alert alert-danger" style="display: none;"></div>
                    <div class="alert alert-success"  style="display: none;"></div>
				<div class="col-md-6">
						<form name="checkout" id="checkout" action="{{ url('checkout') }}" method="get">
							<button type="submit" class="btn btn-warning btn-block float-end p-2">Checkout</button>
					</form>
					
					<form class="card p-2" action="javascript:;">
                    <div class="input-group">
                        <input type="text" class="couponCode form-control" id="code" name="coupon_code" placeholder="Kode Subsidi / Diskon">
                        <button @if(Auth::check()) user="1" @endif type="submit" id="ApplyCoupon" class="btn btn-secondary">Pakai</button>
                    </div>
                </form>
				</div>
                </div>

                <div class="card">
                    <div class="card-body">
					<small><span class="text-muted">Jika ada kendala saat transaksi, Silahan Klik <a href="https://api.whatsapp.com/send?phone=6285343704359" class="btn btn-xs  btn-link">Link ini</a> Untuk terhubung dengan admin</span></small>
					
					</div>
                </div>

            </div>
        </div>
<!-- Property List End -->