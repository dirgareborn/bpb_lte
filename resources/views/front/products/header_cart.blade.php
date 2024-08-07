<?php
use App\Models\Product;
$getCartItems = getCartItems();
?>

<div class="nav-item nav-link dropdown" id="appendMiniCartItems">
<!-- Icon -->
      <a class="text-reset me-3" href="{{ url('cart') }}">
        <i class="fas fa-shopping-cart"></i>
	<span class="badge rounded-pill badge-notification bg-danger">{{ $totalCartItems }}</span>
      </a>
    <ul class="dropdown-menu rounded-0 m-0" role="menu">
        @php $total_price = 0 @endphp
        @foreach($getCartItems as $item)
        <?php
        $getAttributePrice = Product::getAttributePrice($item['product_id'], $item['customer_type']);
        ?>
        <li class="dropdown-item">
            <span class="item">
                <span class="item-left">
                    @if(isset($item['product']['images'][0]['image']) && !empty($item['product']['images'][0]['image']))
                    <a href="{{ url('product/'.$item['product']['id'])}}"><img alt="" src="{{ asset('front/images/products/'.$item['product']['images'][0]['image'])}}"/></a>
                    @else
                    <a href=""><img class="img-fluid" src="img/property-1.jpg" alt=""></a>
                    @endif
                    <span class="item-info">
                        <small><a href="{{ url('product/'.$item['product']['id'])}}">{{ $item['product']['product_name'] }}</a></small><br>
                        <small> @currency($getAttributePrice['final_price'] * $item['qty'])
                        </small>
                    </span>
                </span>
                <span class="item-right">
                <a class="confirmDelete" name="{{ $item['product']['product_name'] }}" href="javascript:void(0)" record="cart-item" recordid="{{ $item['id'] }}" title="Hapus Produk"> <i class="fas fa-trash text-danger"></i> </a>
                </span>
            </span>
        </li>
        @endforeach
        <li class="divider"></li>
        <li class="dropdown-item"><a class="text-center" href="{{ url('cart') }}">Lihat Keranjang</a></li>
    </ul>
</div>