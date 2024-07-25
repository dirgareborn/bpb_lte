@extends('admin.layout.app')

@section('content')
<!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
          <a href="{{ url('admin/cms-pages') }}" class="btn btn-sm btn-flat btn-info float-right"> <i class="fas fa-solid fa-backward"></i> Kembali</a>
            <h3 class="card-title">{{ $title}}</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
              @include('admin.partials.alert')
                <form name="cmsForm" id="cmsForm" @if(empty($cmspage['id'])) action="{{ url('admin/add-edit-cms-page')}}" @else action="{{ url('admin/add-edit-cms-page/'.$cmspage['id'])}}" @endif method="post">@csrf
                <div class="form-group">
                  <label>Judul Halaman</label>
                <input type="text" id="title" name="title" placeholder="Ketikkan Judul Halaman" class="form-control" value="{{ $cmspage['title'] ?? '' }}">
                </div>
                <div class="form-group">
                  <label>URL</label>
                <input type="text" id="url" name="url" placeholder="Ketikkan URL Halaman" class="form-control" value="{{ $cmspage['url'] ?? '' }}">
                </div>
                <div class="form-group">
                  <label>Deskripsi Halaman</label>
                  <textarea name="description" id="description" rows="3" placeholder="Ketikkan Deskripsi Halaman" class="form-control" value="{{ $cmspage['description'] ?? '' }}">{{ $cmspage['description'] ?? '' }} </textarea>
                </div>
                <div class="form-group">
                  <label>Judul Meta</label>
                <input type="text" id="meta_title" name="meta_title" placeholder="Ketikkan Judul Halaman" class="form-control" value="{{ $cmspage['meta_title'] ?? '' }}">
                </div>
                <div class="form-group">
                  <label>Deskripsi Meta</label>
                  <textarea name="meta_description" id="meta_description" rows="3" placeholder="Ketikkan Deskripsi Halaman" class="form-control" value="{{ $cmspage['meta_description'] ?? '' }}">{{ $cmspage['meta_description'] ?? '' }}</textarea>
                </div>
                <div class="form-group">
                  <label>Kata Kunci Meta</label>
                  <input type="text" id="meta_keywords" name="meta_keywords" placeholder="Ketikkan Kata Kunci Meta Pencarian" class="form-control" value="{{ $cmspage['meta_keywords'] ?? '' }}">                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
    
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