@extends('admin.layout.app')

@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card clearfix">
              <div class="card-header clearfix">
                <a href="{{ url('admin/add-edit-coupon') }}" class="btn btn-sm btn-flat btn-info float-right"> <i class="fas fa-plus"></i> Tambah</a>
                <h3 class="card-title">Akun Bank</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              @include('admin.partials.alert')
                <table id="cmspages" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Opsi Kupon</th>
                    <th>Kode Kupon</th>
					<th>Type Kupon</th>
					<th>Type Jumlah</th>
					<th>Jumlah</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($coupons as $coupon)
                  <tr>
                    <td>{{ $coupon['id'] }}</td>
                    <td>{{ $coupon['coupon_option'] }}</td>
                    <td>{{ $coupon['coupon_code'] }}</td>
             
                    <td>{{ $coupon['coupon_type'] }}</td>
                    <td>{{ $coupon['amount_type'] }}</td>
					<td>{{ $coupon['amount'] }}
					@if($coupon['amount_type']=="percentage") % @else IDR @endif
					</td>
                    <td>{{ format_date($coupon['expired_date']) }}</td>
                    <td>{{ date("j F Y", strtotime($coupon['created_at'])); }}</td>
					<td>
                      <a href="{{ url('admin/add-edit-coupon/'.$coupon['id']) }}"> <i class="fas fa-edit text-info"></i> </a>
                          @if($coupon['status']==1)
                          <a class="updateCouponStatus" id="coupon-{{ $coupon['id'] }}" coupon_id="{{ $coupon['id'] }}" href="javascrip:void(0)"><i class="fas fa-toggle-on" status="Active"></i></a>
                          @else
                          <a class="updateCouponStatus" id="coupon-{{ $coupon['id'] }}" coupon_id="{{ $coupon['id'] }}" href="javascrip:void(0)" style="color:grey"><i class="fas fa-toggle-off" status="Inactive"></i></a>
                          @endif
                          <a class="confirmDelete" name="{{ $coupon['coupon_code'] }}" href="javascript:void(0)" record="coupon" recordid="{{ $coupon['id'] }}" title="Hapus Kupon"> <i class="fas fa-trash text-danger"></i> </a>
                        </td>
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
@push('scripts')
@include('admin.partials._swalDeleteConfirm')
@endpush