@extends('admin.layout.app')

@section('content')
<!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <a href="{{ url('admin/coupons') }}" class="btn btn-sm btn-flat btn-info float-right"> <i class="fas fa-solid fa-backward"></i> Kembali</a>
          <h3 class="card-title">{{ $title}}</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
              @include('admin.partials.alert')
                <form name="accountbankForm" enctype="multipart/form-data" id="categoryForm" @if(empty($coupon['id'])) action="{{ url('admin/add-edit-coupon')}}" @else action="{{ url('admin/add-edit-coupon/'.$coupon['id'])}}" @endif method="post">@csrf
                <input type="hidden" id="id" name="id" value="{{ $coupon['id'] ?? '' }}">
                <div class="form-group">
                  <label>Pilihan Kode Kupon &nbsp;</label>
                <input type="radio" id="AutomaticCoupon" name="coupon_option" value="automatic" {{ old('coupon_option', $coupon['coupon_option']) == 'automatic' ? 'checked' : '' }}> &nbsp; Otomatis &nbsp;&nbsp;
				<input type="radio" id="ManualCoupon" name="coupon_option" value="manual" {{ old('coupon_option', $coupon['coupon_option']) == 'manual' ? 'checked' : '' }}> &nbsp; Manual &nbsp;&nbsp;
                </div>
				<div class="form-group" style="display:none;" id="couponField">
                  <label>Kode Kupon</label>
                <input type="text" id="coupon_code" name="coupon_code" placeholder="Ketikkan Nama Bank" class="form-control" value="{{ $coupon['coupon_code'] ?? '' }}">
                </div>
				<div class="form-group">
                  <label>Type Kupon &nbsp;</label>
                <input type="radio" id="SingleCoupon" name="coupon_type" value="single" {{ old('coupon_type', $coupon['coupon_type']) == 'single' ? 'checked' : '' }}> &nbsp; Sekali Pakai &nbsp;&nbsp;
				<input type="radio" id="MultipleCoupon" name="coupon_type" value="multiple" {{ old('coupon_type', $coupon['coupon_type']) == 'multiple' ? 'checked' : '' }}> &nbsp; Berkali-kali  &nbsp;&nbsp;
                </div>
				<div class="form-group">
                  <label>Jenis Kupon &nbsp;</label>
                <input type="radio" id="percentage" name="amount_type" value="percentage" {{ old('amount_type', $coupon['amount_type']) == 'percentage' ? 'checked' : '' }}> &nbsp; Persen % &nbsp;&nbsp;
				<input type="radio" id="fixed" name="amount_type" value="fixed" {{ old('amount_type', $coupon['amount_type']) == 'fixed' ? 'checked' : '' }}> &nbsp; IDR &nbsp;&nbsp;
                </div>
				<div class="form-group">
                <label>Produk</label>
                <select class="form-control select2bs4" multiple="" name="products[]" style="width: 100%;">
                  <option>---Pilih Produk ---</option>
                  @foreach($products as $item)
                  <option @if(in_array($item['id'],$selProds)) selected="" @endif value="{{ $item['id']}}">{{ $item['product_name']}}</option>
                  @endforeach
                </select>
				</div>
				<div class="form-group">
                <label>Customer</label>
                <select class="form-control select2bs4" multiple="" name="users[]" style="width: 100%;">
                  <option>---Pilih Customer ---</option>
                  @foreach($users as $user)
                  <option  @if(in_array($user['email'],$selUsers)) selected="" @endif value="{{ $user['email']}}">{{ $user['email']}}</option>
                  @endforeach
                </select>
            </div>
                <div class="form-group">
                  <label>Nama Kupon</label>
                <input type="text" id="coupon_name" name="coupon_name" placeholder="Ketikkan Nama Kupon" class="form-control" value="{{ $coupon['coupon_name'] ?? '' }}">
                </div>
                <div class="form-group">
                  <label>Jumlah </label>
                <input type="text" id="amount" name="amount" placeholder="Ketikkan Jumlah" class="form-control" value="{{ $coupon['amount'] ?? '' }}">
                </div>
				<div class="form-group">
                  <label>Berlaku Sampai Tanggal</label>
                <input type="date" id="expired_date" name="expired_date" class="form-control" value="{{ $coupon['expired_date'] ?? '' }}">
                </div>
				<div class="form-group">
                  <label>Status &nbsp;</label>
                <input type="radio" id="enable" name="status" value="1" {{ old('status', $coupon['status']) == '1' ? 'checked' : '' }}> &nbsp; Aktif &nbsp;&nbsp;
				<input type="radio" id="disable" name="status" value="0" {{ old('status', $coupon['status']) == '0' ? 'checked' : '' }}> &nbsp; Tidak Aktif &nbsp;&nbsp;
                </div>
                  @if(empty($coupon['id']))
                  <button type="submit" class="btn btn-primary">Simpan</button>
                  @else
                  <button type="submit" class="btn btn-info">Update</button>
                  @endif
                </form>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
</section>
<!-- /.content -->
@endsection


@push('scripts')
@include('admin.partials._swalDeleteConfirm')
@endpush