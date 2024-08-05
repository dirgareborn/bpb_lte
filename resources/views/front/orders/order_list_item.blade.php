        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-11">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-normal mb-0">Daftar Pesanan</h3>
                    <div>
                        <p class="mb-0"><span class="text-muted">Sort by:</span> 
						<a href="#!" class="text-body">Harga <i class="fas fa-angle-down mt-1"></i></a>
						</p>
                    </div>
                </div>

                    @foreach($orders as $item)
                <div class="card mb-6">
                    <div class="card-body">
                        <div class="row d-flex justify-content-between align-items-center">
							<div class="col-md-5 col-lg-4	col-xl-4">
                            <p class="mb-0 price"> Order #<span>{{ $item['id']}}</span></p>
							  <span class="mb-0"></span>
							<small  class="text-muted">Dipesan tanggal {{ format_date($item['created_at']) }}</small>
                            </div>
                            <div class="col-md-4col-lg-4	col-xl-4 offset-lg-2">
                            <p class="mb-0 price">Total: <span> @currency($item['grand_total'])</span></p>
							  <span class="mb-0">Metode Pembayaran : {{ $item['payment_method']}}</span>
							@if($item['order_status']=="Terbayar")
							<small  class="text-primary">Status : {{ $item['order_status']}} </small> <span class="float-end d-flex justify-content-center align-items-center big-dot dot"><i class="fa fa-check text-white"></i></span>
							@elseif($item['order_status']=="Pending")
							<small  class="text-danger">Status : {{ $item['order_status']}} </small>
							@else
							<small  class="text-warning">Status : {{ $item['order_status']}} </small>
							@endif
                            </div>
                            <div class="col-md-2 col-lg-2 col-xl-2 text-center">
                            <a class="confirmDelete" name="{{ $item['id'] }}" href="javascript:void(0)" record="cart-item" recordid="{{ $item['id'] }}" title="Detail Pesanan"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            <a class=" " target="_blank" href="{{url('order-invoice-pdf', $item['id'] )}}"><i class="fa fa-file-pdf text-danger"></i></a>
                            </div>
                        </div>
                    </div>				
                </div>
				&nbsp;
                    @endforeach
            </div>
        </div>
<!-- Property List End -->