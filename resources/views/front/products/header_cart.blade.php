<?php
use App\Models\Product;
use App\Models\Category;
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
		$getCategoryName = Category::select('url')->where('id',$item['product']['category_id'])->first();
        ?>
        <li class="dropdown-item">
            <span class="item">
                <span class="item-left">
                    <span class="item-info">
                        <small><a href="{{ url('kategori/'.$getCategoryName['url'].'/'.$item['product']['url'])}}">{{ $item['product']['product_name'] }}</a></small>
						<br>
                        <small> @currency($getAttributePrice['final_price'] * $item['qty'])
                        </small>
                    </span>
                </span>
                <span class="item-right float-end">
                <a class="confirmDelete" name="{{ $item['product']['product_name'] }}" href="javascript:void(0)" record="cart-item" recordid="{{ $item['id'] }}" title="Hapus Produk"> <i class="fas fa-trash text-danger"></i> </a>
                </span>
            </span>
        </li>
		<li class="divider"></li>
        @endforeach
        <li class="divider"></li>
        <li class="dropdown-item"><a class="text-center" href="{{ url('cart') }}">Lihat Keranjang</a></li>
    </ul>
</div>