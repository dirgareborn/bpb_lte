@extends('admin.layout.app')

@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card clearfix">
              <div class="card-header clearfix">
                <a href="{{ url('admin/add-edit-cms-page') }}" class="btn btn-sm btn-flat btn-info float-right"> <i class="fas fa-plus"></i> Tambah</a>
                <h3 class="card-title">Halaman CMS</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              @include('admin.partials.alert')
                <table id="cmspages" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>URL</th>
                    <th>Tanggal</th>
                    @if($pagesModule['edit_access']==1 || $pagesModule['full_access']==1 )
                    <th>Aksi</th>
                    @endif
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($CmsPages as $page)
                  <tr>
                    <td>{{ $page['id'] }}</td>
                    <td>{{ $page['title'] }}</td>
                    <td>{{ $page['url'] }}</td>
                    <td>{{ date("j F Y", strtotime($page['created_at'])); }}</td>
                    @if($pagesModule['edit_access']==1 || $pagesModule['full_access']==1 )
                    <td>
                      <a href="{{ url('admin/add-edit-cms-page/'.$page['id']) }}"> <i class="fas fa-edit text-info"></i> </a>
                          @if($page['status']==1)
                          <a class="updateCmsPageStatus" id="page-{{ $page['id'] }}" page_id="{{ $page['id'] }}" href="javascrip:void(0)"><i class="fas fa-toggle-on" status="Active"></i></a>
                          @else
                          <a class="updateCmsPageStatus" id="page-{{ $page['id'] }}" page_id="{{ $page['id'] }}" href="javascrip:void(0)" style="color:grey"><i class="fas fa-toggle-off" status="Inactive"></i></a>
                          @endif
                          @endif
                          @if($pagesModule['full_access']==1)
                          <a class="confirmDelete" name="{{ $page['title'] }}" href="javascript:void(0)" record="cms-page" recordid="{{ $page['id'] }}" title="Hapus halaman CMS"> <i class="fas fa-trash text-danger"></i> </a>
                        </td>
                        @endif
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