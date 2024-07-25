@extends('admin.layout.app')

@section('content')
<!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">{{ $title}}</h3>
            <a style="max-width:150px; " href="{{ url('admin/subadmins') }}" class="btn btn-sm btn-info">Kembali</a>
            </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
              @include('admin.partials.alert')
                <form enctype="multipart/form-data" name="subadminForm" id="subadminForm" @if(empty($subadmin['id'])) action="{{ url('admin/add-subadmin')}}" @else action="{{ url('admin/add-subadmin/'.$subadmin['id'])}}" @endif method="post">@csrf
                  <input type="hidden" id="id" name="id" value="{{ $subadmin['id'] ?? '' }}">
                <div class="form-group">
                  <label>Nama</label>
                <input type="text" id="admin_name" name="admin_name" placeholder="Ketikkan Nama Admin" class="form-control" value="{{ $subadmin['name'] ?? '' }}">
                </div>
                <div class="form-group">
                  <label>Type Admin</label>
                <input type="text" id="admin_type" name="admin_type" placeholder="Ketikkan type Admin" class="form-control" value="{{ $subadmin['type'] ?? '' }}">
                </div>
                <div class="form-group">
                  <label>No. Handphone</label>
                <input type="text" id="admin_mobile" name="admin_mobile" placeholder="Ketikkan No. handphone" class="form-control" value="{{ $subadmin['mobile'] ?? '' }}">
                </div>
                <div class="form-group">
                  <label>Email</label>
                <input type="email" id="admin_email" name="admin_email" placeholder="Ketikkan Email" class="form-control" @if(!empty($subadmin['email'])) value="{{ $subadmin->email ?? '' }}" @endif>
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" id="admin_password" name="admin_password" placeholder="Ketikkan Password" class="form-control" value="{{ $subadmin['password'] ?? '' }}">
                  </div>
                  <div class="form-group">
                    <label for="handphone">Image</label>
                    <input type="file" name="admin_image" id="admin_image" value="{{ $subadmin['image'] ?? '' }}" class="form-control">
                    <br>
                    @if(!empty($subadmin['image']))
                    <a target="_blank" href="{{ url('admin/images/avatars/'.$subadmin['image']) }}" > Lihat Foto </a>
                    <input type="hidden"  name="current_image" value="{{ $subadmin['image'] ?? '' }}" class="form-control">
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
    
                </form>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          </div>
          <!-- /.card-body -->
</section>
<!-- /.content -->
@endsection