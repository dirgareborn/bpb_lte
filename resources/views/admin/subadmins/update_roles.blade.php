@extends('admin.layout.app')

@section('content')
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- SELECT2 EXAMPLE -->
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">{{ $title}}</h3>
        <a style="max-width:150px; float:right; display:inline-block" href="{{ url('admin/subadmins') }}" class="btn btn-sm btn-info">Kembali</a>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            @include('admin.partials.alert')
            <form enctype="multipart/form-data" name="subadminForm" id="subadminForm" action="{{ url('admin/update-role/'.$id)}}" method="post">@csrf
              <input type="hidden" id="id" name="id" value="{{ $id }}">
              @if(!empty($adminRoles))
                @foreach($adminRoles as $role)
                  @if($role['module']=="cms_pages")
                    @if($role['view_access']==1)
                      @php $viewCMSPages = "checked" @endphp
                    @else
                      @php $viewCMSPages = "" @endphp
                    @endif
                    @if($role['edit_access']==1)
                      @php $editCMSPages = "checked" @endphp
                    @else
                      @php $editCMSPages = "" @endphp
                    @endif
                    @if($role['full_access']==1)
                      @php $fullCMSPages = "checked" @endphp
                    @else
                      @php $fullCMSPages = "" @endphp
                    @endif
                  @endif
                  @if($role['module']=="categories")
                    @if($role['view_access']==1)
                      @php $viewCategories = "checked" @endphp
                    @else
                      @php $viewCategories = "" @endphp
                    @endif
                    @if($role['edit_access']==1)
                      @php $editCategories = "checked" @endphp
                    @else
                      @php $editCategories = "" @endphp
                    @endif
                    @if($role['full_access']==1)
                      @php $fullCategories = "checked" @endphp
                    @else
                      @php $fullCategories = "" @endphp
                    @endif
                  @endif
                  @if($role['module']=="products")
                    @if($role['view_access']==1)
                      @php $viewProducts = "checked" @endphp
                    @else
                      @php $viewProducts = "" @endphp
                    @endif
                    @if($role['edit_access']==1)
                      @php $editProducts = "checked" @endphp
                    @else
                      @php $editProducts = "" @endphp
                    @endif
                    @if($role['full_access']==1)
                      @php $fullProducts = "checked" @endphp
                    @else
                      @php $fullProducts = "" @endphp
                    @endif
                  @endif
                @endforeach
              @endif

                <div class="card-body">
                  <div class="form-group col-md-6">
                    <label>Halaman CMS </label>
                    <input value="1" @if(isset($viewCMSPages)) {{ $viewCMSPages }} @endif type="checkbox" id="cms_pages" name="cms_pages[view]"> Akses View &nbsp;
                    <input value="1" @if(isset($editCMSPages)) {{ $editCMSPages }} @endif type="checkbox" id="cms_pages" name="cms_pages[edit]"> View / Edit Akses &nbsp;
                    <input value="1" @if(isset($fullCMSPages)) {{ $fullCMSPages }} @endif type="checkbox" id="cms_pages" name="cms_pages[full]"> Full Akses &nbsp;
                  </div>
                  <div class="form-group col-md-6">
                    <label>Kategori </label>
                    <input value="1" @if(isset($viewCategories)) {{ $viewCategories }} @endif type="checkbox" id="categories" name="categories[view]"> Akses View &nbsp;
                    <input value="1" @if(isset($editCategories)) {{ $editCategories }} @endif type="checkbox" id="categories" name="categories[edit]"> View / Edit Akses &nbsp;
                    <input value="1" @if(isset($fullCategories)) {{ $fullCategories }} @endif type="checkbox" id="categories" name="categories[full]"> Full Akses &nbsp;
                  </div>
                  <div class="form-group col-md-6">
                    <label>Produk </label>
                    <input value="1" @if(isset($viewProducts)) {{ $viewProducts }} @endif type="checkbox" id="products" name="products[view]"> Akses View &nbsp;
                    <input value="1" @if(isset($editProducts)) {{ $editProducts }} @endif type="checkbox" id="products" name="products[edit]"> View / Edit Akses &nbsp;
                    <input value="1" @if(isset($fullProducts)) {{ $fullProducts }} @endif type="checkbox" id="products" name="products[full]"> Full Akses &nbsp;
                  </div>
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