@extends('admin.layout.app')

@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card clearfix">
              <div class="card-header clearfix">
                <a href="{{ url('admin/add-order') }}" class="btn btn-sm btn-flat btn-info float-right"> <i class="fas fa-plus"></i> Tambah</a>
                <h3 class="card-title">Daftar Orderan</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              @include('admin.partials.alert')
                <table id="" class="table table-sm">
                  <thead>
                  <tr>
                    <th>ID Order</th>
                    <th>Tanggal Order</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Produk Order</th>
                    <th>Harga</th>
                    <th>Status Order</th>
                    <th>Metode Pembayaran</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($orders as  $order)
                  <tr>
                    <td>{{ $order['id']}}</td>
                    <td>{{ date("j F Y", strtotime($order['created_at'])); }}</td>
                    <td>{{ $order['users']['name'] }}</td>
                    <td>{{ $order['users']['email'] }}</td>
                    <td>
					@foreach( $order['orders_products'] as $product)
						<p>{{ $product['product_name'] }} </p>
					<small> Tanggal Pemakaian :	{{ format_date($product['start_date']) }} </small>
					@endforeach
					</td>
                    <td>{{ $order['grand_total'] }}</td>
                    <td>{{ $order['order_status'] }}</td>
                    <td>{{ $order['payment_method'] }}</td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              
			  </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection