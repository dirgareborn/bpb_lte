@extends('admin.layout.app')

@section('content')
<!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <a href="{{ url('admin/banners') }}" class="btn btn-sm btn-flat btn-info float-right"> <i class="fas fa-solid fa-backward"></i> Kembali</a>
          <h3 class="card-title">{{ $title}}</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
              @include('admin.partials.alert')
                <form name="bannerForm" enctype="multipart/form-data" id="bannerForm" @if(empty($banner['id'])) action="{{ url('admin/add-edit-banner')}}" @else action="{{ url('admin/add-edit-banner/'.$banner['id'])}}" @endif method="post">@csrf
                <input type="hidden" id="id" name="id" value="{{ $banner['id'] ?? '' }}">
                <div class="form-group">
                  <label>Nama Banner</label>
                <input type="text" id="title" name="title" placeholder="Ketikkan Judul Banner" class="form-control" value="{{ $banner['title'] ?? '' }}">
                </div>
                <div class="form-group">
                  <label>Foto / Background</label>
                <input type="file" id="banner_image" name="banner_image" placeholder="Input Foto" class="form-control" value="{{ $banner['image'] ?? '' }}">
                <br>
                    @if(!empty($banner['image']))
                    <a target="_blank" href="{{ url('front/images/banners/'.$banner['image']) }}" >
                    <img style="max-width:150px;" src="{{ asset('front/images/banners/'. $banner['image'])}}" alt=""></a>
                    <a class="confirmDelete" href="javascript:void(0)" record="banner-image" recordid="{{ $banner['id'] }}" title="Hapus Foto Banner"> <i class="fas fa-trash text-danger"></i> </a>
                    <input type="hidden"  name="current_image" value="{{ $banner['image'] ?? '' }}" class="form-control">
                    @endif
                </div>
                <div class="form-group">
                  <label>Type</label>
                <input type="text" id="type" name="type" placeholder="Ketikkan Type Banner" class="form-control" value="{{ $banner['type'] }}" >
                </div>
                <div class="form-group">
                  <label>Link / URL </label>
                <input type="text" id="link" name="link" placeholder="Ketikkan Link Banner" class="form-control" value="{{ $banner['link'] ?? '' }}">
                </div>
                <div class="form-group">
                  <label>Alt</label>
                  <input type="text" id="alt" name="alt" placeholder="Ketikkan Alternatif Preview Banner" class="form-control" value="{{ $banner['alt'] ?? '' }}">
                  </div>
                <div class="form-group">
                  <label>Urutan</label>
                <input type="text" id="sort" name="sort" placeholder="Ketikkan Judul Halaman" class="form-control" value="{{ $banner['sort']  }}">
                </div>
                <div class="form-group">
                @if(empty($banner['id']))
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