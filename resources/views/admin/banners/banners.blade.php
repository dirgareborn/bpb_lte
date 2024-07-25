@extends('admin.layout.app')

@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card clearfix">
              <div class="card-header clearfix">
                <a href="{{ url('admin/add-edit-banner') }}" class="btn btn-sm btn-flat btn-info float-right"> <i class="fas fa-plus"></i> Tambah</a>
                <h3 class="card-title">Kategori Layanan</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              @include('admin.partials.alert')
                <table id="cmspages" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Banner</th>
                    <th>Type</th>
                    <th>Judul</th>
                    <th>alternatif</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($banners as $banner)
                  <tr>
                    <td>{{ $banner['id'] }}</td>
                    <td>
                      <a target="_blank" href="{{ url('front/images/banners/'.$banner['image']) }}" >
                      <img style="max-width:150px;" src="{{ asset('front/images/banners/'. $banner['image'])}}" alt=""></a>
                    </td>
                    <td>{{ $banner['type'] }}</td>
                    <td>{{ $banner['title'] }}</td>
                    <td>{{ $banner['alt'] }}</td>
                    <td>{{ date("j F Y", strtotime($banner['created_at'])); }}</td>                    <td>
                      <a href="{{ url('admin/add-edit-banner/'.$banner['id']) }}"> <i class="fas fa-edit text-info"></i> </a>
                          @if($banner['status']==1)
                          <a class="updateBannerStatus" id="banner-{{ $banner['id'] }}" banner_id="{{ $banner['id'] }}" href="javascrip:void(0)"><i class="fas fa-toggle-on" status="Active"></i></a>
                          @else
                          <a class="updateBannerStatus" id="banner-{{ $banner['id'] }}" banner_id="{{ $banner['id'] }}" href="javascrip:void(0)" style="color:grey"><i class="fas fa-toggle-off" status="Inactive"></i></a>
                          @endif
                          <a class="confirmDelete" name="{{ $banner['title'] }}" href="javascript:void(0)" record="banner" recordid="{{ $banner['id'] }}" title="Hapus Banner"> <i class="fas fa-trash text-danger"></i> </a>
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