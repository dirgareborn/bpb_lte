@extends('admin.layout.app')

@section('content')
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- SELECT2 EXAMPLE -->
    <div class="card card-default">
      <div class="card-header">
        <a href="{{ url('admin/products') }}" class="btn btn-sm btn-flat btn-info float-right"> <i class="fas fa-solid fa-backward"></i> Kembali</a>
        <h3 class="card-title">{{ $title}}</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            @include('admin.partials.alert')
            <form name="productForm" enctype="multipart/form-data" id="productForm" @if(empty($product['id'])) action="{{ url('admin/add-edit-product')}}" @else action="{{ url('admin/add-edit-product/'.$product['id'])}}" @endif method="post">@csrf
              <input type="hidden" id="id" name="id" value="{{ $product['id'] ?? '' }}">
              <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" id="product_name" name="product_name" placeholder="Ketikkan Nama Produk" class="form-control" value="{{ $product['product_name'] ?? '' }}">
              </div>
              
              <div class="form-group">
                <label>Harga </label>
                <input type="text" id="product_price" name="product_price" placeholder="Ketikkan Harga " class="form-control" value="{{ $product['product_price'] ?? '' }}">

                <!-- <table id="myTable table-responsive" class="table order-list" width="100%">
								<thead>
									<tr>
										<th width="80%">Harga</th>
										<th> <input type="button" class="btn btn-xs btn-success" id="addrow" value="Tambah Baris" /></th>
									</tr>
								</thead>
								<tbody>
									<tr></tr>
								</tbody>
							</table> -->
              </div>
              <div class="form-group">
                <label>Kategori Produk</label>
                <select class="form-control select2bs4" id="category_id" name="category_id" style="width: 100%;">
                  <option value="0">---Pilih Kategori ---</option>
                    @foreach($getCategories as $cat)
                    <option @if(isset($product['category_id'])&&$product['category_id']==$cat['id']) selected="selected" @endif value="{{ $cat['id']}}">&raquo; {{ $cat['category_name']}}</option>
                      @if(!empty($cat['subcategories']))
                        @foreach($cat['subcategories'] as $subcat)
                          <option @if(isset($product['category_id'])&&$product['category_id']==$subcat['id']) selected="selected" @endif value="{{ $subcat['id']}}">&nbsp;&nbsp;&raquo;&raquo; {{ $subcat['category_name']}}</option>
                          @if(!empty($subcat['subcategories']))
                            @foreach($subcat['subcategories'] as $subsubcat)
                            <option @if(isset($product['category_id'])&&$product['category_id']==$subsubcat['id']) selected="selected" @endif value="{{ $subsubcat['id']}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&raquo;&raquo; {{ $subsubcat['category_name']}}</option>
                            @endforeach
                          @endif
                        @endforeach
                      @endif
                    @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Lokasi</label>
                <select class="form-control select2bs4" id="location_id" name="location_id" style="width: 100%;">
                  <option>---Pilih Lokasi ---</option>
                  @foreach($getLocations as $loc)
                  <option @if(isset($product['location_id'])&&$product['location_id']==$loc['id']) selected="selected" @endif value="{{ $loc['id']}}">{{ $loc['name']}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Cover Produk</label>
                <input type="file" id="cover_image"  name="cover_image" placeholder="Input Foto" class="form-control" value="{{ $product['product_image'] ?? '' }}">
                <br>
                @if(!empty($product['product_image']))
                <a target="_blank" href="{{ url('front/images/products/'.$product['product_image']) }}">
                  <img style="max-width:150px;" src="{{ asset('front/images/products/'. $product['product_image'])}}" alt=""></a>
                <a class="confirmDelete" href="javascript:void(0)" record="product-image" recordid="{{ $product['id'] }}" title="Hapus Foto Kategori"> <i class="fas fa-trash text-danger"></i> </a>
                <input type="hidden" name="current_image" value="{{ $product['product_image'] ?? '' }}" class="form-control">
                @endif
              </div>
              <div class="form-group">
                <label>Foto Slide</label>
                <input type="file" id="slide_images" multiple="" name="slide_images[]" placeholder="Input Foto" class="form-control" value="{{ $product['slide_images'] ?? '' }}">
                <br>
               
                @forelse($productSlide as $slide)
                <a target="_blank" href="{{ url('front/images/products/galery/'.$slide['image']) }}">
                  <img style="max-width:150px;" src="{{ asset('front/images/products/galery/'. $slide['image'])}}" alt=""></a>
                <a class="confirmDelete" href="javascript:void(0)" record="slide-image" recordid="{{ $slide['id'] }}" title="Hapus Foto Kategori"> <i class="fas fa-trash text-danger"></i> </a>
                <input type="hidden" name="current_slide_image[]" value="{{ $slide['image'] ?? '' }}[]" class="form-control">
                @empty
                @endforelse
              </div>
              <div class="form-group">
                <label>Fasilitas</label>
                <textarea name="product_facility" id="summernote" rows="3" placeholder="Ketikkan Deskripsi Halaman" class="form-control" value="{{ $product['product_facility'] ?? '' }}">{{ $product['product_facility'] ?? '' }}</textarea>
              </div>
              <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="product_description" id="product_description" rows="3" placeholder="Ketikkan Deskripsi Halaman" class="form-control" value="{{ $product['description'] ?? '' }}"> {{ $product['product_description'] ?? ''}} </textarea>
              </div>
              <div class="form-group">
                <label>Judul Meta</label>
                <input type="text" id="meta_title" name="meta_title" placeholder="Ketikkan Judul Halaman" class="form-control" value="{{ $product['meta_title']  ?? '' }}">
              </div>
              <div class="form-group">
                <label>Deskripsi Meta</label>
                <textarea name="meta_description" id="meta_description" rows="3" placeholder="Ketikkan Deskripsi Halaman" class="form-control" value="{{ $product['meta_description'] ?? '' }}">{{ $product['meta_description'] ?? '' }}</textarea>
              </div>
              <div class="form-group">
                <label>Meta Pencarian</label>
                <input type="text" id="meta_keywords" name="meta_keywords" placeholder="Ketikkan Kata Kunci Meta Pencarian" class="form-control" value="{{ $product['meta_keywords'] ?? '' }}">
              </div>
              @if(empty($category['id']))
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

@push('scripts')
<script>
	$(document).ready(function() {
		var counter = 0;
		$("#addrow").on("click", function() {
			var newRow = $("<tr>");
			var cols = "";
			cols += '<td><div class="form-group"><input type="text" class="form-control input-square" name="product_price[' + counter + '][name]"/></div></td>';
			cols += '<td><div class="form-group"><input type="text" class="form-control input-square" name="product_price[' + counter + '][price]"/></div></td>';
			cols += '<td><div class="form-group"><input type="button" class="ibtnDel btn btn-xs btn-danger "  value="Delete"></div></td>';
			newRow.append(cols);
			$("table.order-list").append(newRow);
			counter++;
		});
		$("table.order-list").on("click", ".ibtnDel", function(event) {
			$(this).closest("tr").remove();
			counter -= 1
		});
	});
</script>
@include('admin.partials._swalDeleteConfirm')
@endpush