<?php
use App\Models\Product; ?>
@php $total_price = 0 @endphp
@foreach($orderDetails as $order)
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>INVOICE ID : #036-14{{ $order['id'] }}</title>

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }
    .gray {
        background-color: lightgray
    }
</style>

</head>
<body>



<table width="100%">
    <tr>
    <td align="center"> <img src="./logo.png" alt="" width="100"/>
    <h3>Badan Pengembangan Bisnis <br> Universitas Negeri Makassar</h3>
    </td>
    </tr>
  </table>
  <table width="100%">
    <tr>
      <td align="left">
        
<pre>
Kepada     : {{$order['name'] }}
Telepon    : {{$order['mobile'] }}
Alamat      : {{$order['address'] }}
Kode Pos  : {{$order['pincode'] }}
</pre>

        <td valign="top"></td>
        <td align="">
        
            <pre>
                INVOICE
                ID : #036-14{{ $order['id'] }}
                Tanggal Pemesanan : {{format_date($order['created_at']) }}
                Status  :  {{$order['order_status'] }}
            </pre>
        </td>
    </tr>

  </table>


  <br/>

  <table width="100%">
    <thead style="background-color: lightgray;">
      <tr>
        <th>#</th>
        <th>Deskripsi</th>
        <th>Tanggal Penggunaan</th>
        <th>Harga</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
    @foreach($order['orders_products'] as $key => $product)
              <?php
              $getAttributePrice = Product::getAttributePrice($product['product_id'], $product['customer_type']);
              ?>
      <tr>
        <th scope="row">{{ $key + 1; }}</th>
        <td>{{ $product['product_name'] }}</td>
        <td align="left">{{ format_date($product['start_date']) }} - {{ format_date($product['end_date']) }}</td>
        <td align="left">@currency($product['product_price'])</td>
        <td align="right">@currency($product['product_price']*$product['qty'])</td>
      </tr>
      @php $total_price = $total_price + ($getAttributePrice['final_price']* $product['qty'] );
              @endphp
              @endforeach
    </tbody>

    <tfoot>
        <tr>
            <td colspan="3"></td>
            <td align="right">Subtotal </td>
            <td align="right">@currency($total_price)</td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td align="right">Subsidi (Diskon) </td>
            <td align="right">
                @currency($order['coupon_amount'])
                </td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td align="right">Grand Total </td>
            <td align="right" class="gray">@currency($order['grand_total'])</td>
        </tr>
    </tfoot>
  </table>
  <table>
           <small>Silahkan menyelesaikan Pembayaran dengan akun pembayaran berikut</small><br><br>
            @foreach($banks as $bank)
            <?php
            $path = "front/images/banks/".$bank['bank_icon'];
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            ?>
            <img src="<?php echo $base64?>" width="35px">
            
            <small> a.n {{ $bank['account_name'] }} </small><br>
            <small>No. Rekening {{ $bank['account_number'] }} </small><br><br>
            @endforeach
  </table>
  @endforeach
</body>
</html>
