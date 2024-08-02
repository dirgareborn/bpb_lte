@extends('admin.layout.app')

@section('content')
<!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <a href="{{ url('admin/account-banks') }}" class="btn btn-sm btn-flat btn-info float-right"> <i class="fas fa-solid fa-backward"></i> Kembali</a>
          <h3 class="card-title">{{ $title}}</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
              @include('admin.partials.alert')
                <form name="accountbankForm" enctype="multipart/form-data" id="categoryForm" @if(empty($accountbank['id'])) action="{{ url('admin/add-edit-account-bank')}}" @else action="{{ url('admin/add-edit-account-bank/'.$accountbank['id'])}}" @endif method="post">@csrf
                <input type="hidden" id="id" name="id" value="{{ $accountbank['id'] ?? '' }}">
                <div class="form-group">
                  <label>Nama Bank</label>
                <input type="text" id="bank_name" name="bank_name" placeholder="Ketikkan Nama Bank" class="form-control" value="{{ $accountbank['bank_name'] ?? '' }}">
                </div>
                <div class="form-group">
                  <label>Logo Bank</label>
                <input type="file" id="bank_icon" name="bank_icon" placeholder="Input Foto" class="form-control" value="{{ $accountbank['bank_icon'] ?? '' }}">
                <br>
                    @if(!empty($accountbank['bank_icon']))
                    <a target="_blank" href="{{ url('front/images/banks/'.$accountbank['bank_icon']) }}" >
                    <img style="max-width:150px;" src="{{ asset('front/images/banks/'. $accountbank['bank_icon'])}}" alt=""></a>
                    <a class="confirmDelete" href="javascript:void(0)" record="account-bank-icon" recordid="{{ $accountbank['id'] }}" title="Hapus Logo Bank"> <i class="fas fa-trash text-danger"></i> </a>
                    <input type="hidden"  name="current_image" value="{{ $accountbank['bank_icon'] ?? '' }}" class="form-control">
                    @endif
                </div>
                <div class="form-group">
                  <label>Nama Rekening</label>
                <input type="text" id="account_name" name="account_name" placeholder="Ketikkan Nama Rekening" class="form-control" value="{{ $accountbank['account_name'] ?? '' }}">
                </div>
                <div class="form-group">
                  <label>Nomor Rekening </label>
                <input type="text" id="account_number" name="account_number" placeholder="Ketikkan Nomor Rekening" class="form-control" value="{{ $accountbank['account_number'] ?? '' }}">
                </div>
                  @if(empty($accountbank['id']))
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