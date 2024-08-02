@extends('admin.layout.app')

@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card clearfix">
              <div class="card-header clearfix">
                <a href="{{ url('admin/add-edit-account-bank') }}" class="btn btn-sm btn-flat btn-info float-right"> <i class="fas fa-plus"></i> Tambah</a>
                <h3 class="card-title">Akun Bank</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              @include('admin.partials.alert')
                <table id="cmspages" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nama Bank</th>
                    <th>Nama Rekening</th>
                    <th>Nomor Rekening</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($accountBanks as $bank)
                  <tr>
                    <td>{{ $bank['id'] }}</td>
                    <td>@if(isset($bank['bank_icon']))
                        <img    src="{{ asset('front/images/banks/'. $bank['bank_icon'])}}" width="40px">
                        @endif {{ $bank['bank_name'] }}</td>
                    <td>
                        {{ $bank['account_name'] }}

                    </td>
                    <td>{{ $bank['account_number'] }}</td>
                    <td>{{ date("j F Y", strtotime($bank['created_at'])); }}</td>                    <td>
                      <a href="{{ url('admin/add-edit-account-bank/'.$bank['id']) }}"> <i class="fas fa-edit text-info"></i> </a>
                          @if($bank['status']==1)
                          <a class="updateAccountBankStatus" id="bank-{{ $bank['id'] }}" bank_id="{{ $bank['id'] }}" href="javascrip:void(0)"><i class="fas fa-toggle-on" status="Active"></i></a>
                          @else
                          <a class="updateAccountBankStatus" id="bank-{{ $bank['id'] }}" bank_id="{{ $bank['id'] }}" href="javascrip:void(0)" style="color:grey"><i class="fas fa-toggle-off" status="Inactive"></i></a>
                          @endif
                          <a class="confirmDelete" name="{{ $bank['bank_name'] }}" href="javascript:void(0)" record="account-bank" recordid="{{ $bank['id'] }}" title="Hapus Akun Bank"> <i class="fas fa-trash text-danger"></i> </a>
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