
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-10">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-normal mb-0">Keranjang Belanja</h3>
                    <div>
                        <p class="mb-0"><span class="text-muted">Sort by:</span> <a href="#!" class="text-body">Harga <i class="fas fa-angle-down mt-1"></i></a></p>
                    </div>
                </div>

                <div class="card rounded-3 mb-4">
				<?php use App\Models\Product; ?>
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
                                <small><span class="text-muted">Kategori: {{ $item['product']['categories']['category_name']}}</span></small>
                            </div>
                            <div class="col-md-2 col-lg-2 col-xl-2 d-flex">
                            <p class="lead fw-normal mb-2">{{ format_date($item['start_date']) }}</p>
                            </div>
                            <div class="col-md-4 col-lg-4 col-xl-3 offset-lg-1">

                            <hp class="mb-0 price">Harga: <span> @currency($getAttributePrice['final_price'] * $item['qty'])</span></p>
                                
                            @if($getAttributePrice['discount']>0) 
                                Diskon {{ $getAttributePrice['discount_percent'] }} % Dari
                                <del>@currency($getAttributePrice['product_price']* $item['qty'])</del>
                                @endif

                            </div>
                            <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                            <a class="confirmDelete" name="{{ $item['product']['product_name'] }}" href="javascript:void(0)" record="cart-item" recordid="{{ $item['id'] }}" title="Hapus Produk"> <i class="fas fa-trash text-danger"></i> </a>
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
                            <h6 class="form-label">Sub Total @currency($total_price)</h6> 
                        </div>
                    </div>
                </div>

                </div>

                <div class="card">
                    <div class="card-body">
					<a href="https://api.whatsapp.com/send?phone=6285343704359" class="btn btn-success btn-block float-end">Hubungi admin</a>
					<form name="checkout" id="checkout" action="{{ url('checkout') }}" method="get">
					<input type="hidden" name="cart_id" value="{{ $cart_id ?? '' }}">
					<input type="hidden" name="item_id" value="{{ $item_id ?? ''}}">
					<input type="hidden" name="item_name" value="{{ $item_name ?? ''}}">
					<input type="hidden" name="item_tgl" value="{{ $item_tgl ?? '' }}">
                    <button type="submit" class="btn btn-warning btn-block float-end">Proses Untuk Checkout</button>
                    </form>
					</div>
                </div>

            </div>
        </div>
<!-- Property List End -->