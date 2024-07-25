@extends('admin.layout.app')

@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Admin</h3>
                <a style="max-width:150px; float:right; display:inline-block" href="{{ url('admin/add-subadmin') }}" class="btn btn-sm btn-info"> Tambah Admin</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              @include('admin.partials.alert')
                <table id="subadmins" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>No. Handphone</th>
                    <th>Email</th>
                    <th>Type User</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($subadmins as $subadmin)
                  <tr>
                    <td>{{ $subadmin->id }}</td>
                    <td>{{ $subadmin->name }}</td>
                    <td>{{ $subadmin->mobile }}</td>
                    <td>{{ $subadmin->email }}</td>
                    <td>{{ $subadmin->type }}</td>
                    <td>{{ date("j F Y", strtotime($subadmin->created_at)); }}</td>
                    <td>
                    <a href="{{ url('admin/add-subadmin/'.$subadmin->id)  }}"> <i class="fas fa-edit text-info"></i> </a>
                    @if($subadmin['status']==1)
                    <a class="updateSubAdminStatus" id="subadmin-{{ $subadmin['id'] }}" subadmin_id="{{ $subadmin->id }}" href="javascript:void(0)"><i class="fas fa-toggle-on" status="Active"></i></a>
                    @else
                    <a class="updateSubAdminStatus" id="subadmin-{{ $subadmin['id'] }}" subadmin_id="{{ $subadmin->id }}" href="javascript:void(0)" style="color:grey"><i class="fas fa-toggle-off" status="Inactive"></i></a>
                    @endif
                    <a class="confirmDelete" name="{{ $subadmin->name }}" href="javascript:void(0)" record="subadmin" recordid="{{ $subadmin->id }}" title="Hapus Admin"> <i class="fas fa-trash text-danger"></i> </a>
                    <a href="{{ url('admin/update-role/'.$subadmin->id)  }}"> <i class="fas fa-unlock text-warning"></i> </a>
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