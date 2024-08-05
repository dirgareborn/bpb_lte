<?php

use App\Models\Product; ?>
@php $total_price = 0 @endphp
@foreach($orders as $order)
<div class="card">
  <div class="card-body">
    <div class="container mb-5 mt-3">
      <div class="row d-flex align-items-baseline">
        <div class="col-xl-9">
          <p style="color: #7e8d9f;font-size: 20px;">Invoice >> <strong>ID: #036-14{{ $order['id'] }}</strong></p>
        </div>
        <div class="col-xl-3 float-end">
          <a data-mdb-ripple-init class="btn btn-light text-capitalize border-0" data-mdb-ripple-color="dark" href="{{url('download-invoice-pdf', $order['id'] )}}"><i class="fas fa-print text-primary"></i> Print</a>
          <a data-mdb-ripple-init class="btn btn-light text-capitalize" target="_blank" data-mdb-ripple-color="dark" href="{{url('order-invoice-pdf', $order['id'] )}}"><i class="far fa-file-pdf text-danger"></i> Export</a>
        </div>
        <hr>
      </div>

      <div class="container">
        <div class="col-md-12">
          <div class="text-center">
            <i class="fab fa-mdb fa-4x ms-0" style="color:#5d9fc5 ;"></i>
            <p class="pt-0">Badan Pengembangan Bisnis <br> Universitas Negeri Makassar</p>
          </div>

        </div>


        <div class="row">
          <div class="col-xl-8">
            <ul class="list-unstyled">
              <li class="text-muted">To: <span style="color:#5d9fc5 ;"> {{$order['name'] }}</span></li>
              <li class="text-muted">{{$order['address'] }}</li>
              <li class="text-muted">Kode Pos {{$order['pincode'] }}</li>
              <li class="text-muted"><i class="fas fa-phone"></i> {{$order['mobile'] }}</li>
            </ul>
          </div>
          <div class="col-xl-4">
            <p class="text-muted">Invoice</p>
            <ul class="list-unstyled">
              <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span class="fw-bold">ID:</span>#036-14{{ $order['id'] }}</li>
              <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span class="fw-bold">Tanggal Pesanan: </span>{{format_date($order['created_at']) }}</li>
              <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span class="me-1 fw-bold">Status:</span><span class="badge bg-warning text-black fw-bold">
                  {{$order['order_status'] }}</span></li>
            </ul>
          </div>
        </div>

        <div class="row my-2 mx-1 justify-content-center">
          <table class="table table-striped table-borderless">
            <thead style="background-color:#84B0CA ;" class="text-white">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Tanggal Pemakaian</th>
                <th scope="col">Harga Produk</th>
                <th scope="col">Jumlah</th>
              </tr>
            </thead>
            <tbody>

              @foreach($order['orders_products'] as $key => $product)
              <?php
              $getAttributePrice = Product::getAttributePrice($product['product_id'], $product['customer_type']);
              ?>
              <tr>
                <th scope="row">{{ $key + 1; }}</th>
                <td>
                  {{ $product['product_name'] }}
                </td>
                <td> {{ $product['start_date'] }} - {{ $product['end_date'] }}

                </td>
                <td>@currency($product['product_price'])</td>
                <td>@currency($product['product_price']*$product['qty'])</td>
              </tr>
              @php $total_price = $total_price + ($getAttributePrice['final_price']* $product['qty'] );
              @endphp
              @endforeach
            </tbody>

          </table>
        </div>
        <div class="row">
          <div class="col-xl-8">
            <p class="ms-3">Silahkan menyelesaikan Pembayaran dengan akun pembayaran berikut</p>
            @foreach($banks as $bank)
            <img src="{{ asset('front/images/banks/'. $bank['bank_icon']) }}" width="45px"><br>
            <small> a.n {{ $bank['account_name'] }} </small><br>
            <small>No. Rekening {{ $bank['account_number'] }} </small><br>
            @endforeach
          </div>
          <div class="col-xl-3">
            <ul class="list-unstyled">
              <li class="text-muted float-start"><span class="text-black me-2">SubTotal</span>
              <strong style="margin-left: 70px;"> @currency($total_price)</strong>
              </li>
              <li class="text-muted float-start"><span class="text-black me-4">Subsidi (Diskon) </span>
                <strong class="couponAmount">
                  @currency($order['coupon_amount'])
                </strong>
              </li>
              <li class="text-muted float-start"><span class="text-black me-4"> Grand Total</span>
                <strong style="margin-left: 35px;">@currency($order['grand_total'])
                </strong>
              </li>
            </ul>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-xl-10">
            <p>Terima kasih atas Kepercayaan Anda</p>
          </div>
          <div class="col-xl-2">
            <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-info text-white" style="background-color:#60bdf3 ;">Bayar Sekarang</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endforeach