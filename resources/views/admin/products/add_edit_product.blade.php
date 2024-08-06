@extends('admin.layout.app')
@push('style')
<style>
.form-attribute{width:20%;
padding:.375rem .75rem;
font-size:1rem;
line-height:1.5;
color:#495057;
background-color:#fff;
background-clip:padding-box;
border:1px solid #ced4da;
border-radius:.25rem;
transition:border-color 
.15s ease-in-out,box-shadow .
15s ease-in-out}
.form-attribute:
focus{color:#495057;background-color:#fff;border-color:#80bdff;outline:0;box-shadow:0 0 0 .2rem rgba(0,123,255,.25)}.form-control::-webkit-input-placeholder{color:#6c757d;opacity:1}.form-control::-moz-placeholder{color:#6c757d;opacity:1}.form-control:-ms-input-placeholder{color:#6c757d;opacity:1}.form-control::-ms-input-placeholder{color:#6c757d;opacity:1}.form-control::placeholder{color:#6c757d;opacity:1}


</style>
@endpush
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
            @include('admin.partials.alert')
            <form name="productForm" enctype="multipart/form-data" id="productForm" @if(empty($product['id'])) action="{{ url('admin/add-edit-product')}}" @else action="{{ url('admin/add-edit-product/'.$product['id'])}}" @endif method="post">@csrf
              <input type="hidden" id="id" name="id" value="{{ $product['id'] ?? '' }}">
        <div class="row">
        <div class="col-md-4">
              <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" id="product_name" name="product_name" placeholder="Ketikkan Nama Produk" class="form-control" value="{{ $product['product_name'] ?? '' }}">
              </div>
			  </div>
		<div class="col-md-4">
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
		</div>
		<div class="col-md-4">
			<div class="form-group">
                <label>Lokasi</label>
                <select class="form-control select2bs4" id="location_id" name="location_id" style="width: 100%;">
                  <option>---Pilih Lokasi ---</option>
                  @foreach($getLocations as $loc)
                  <option @if(isset($product['location_id'])&&$product['location_id']==$loc['id']) selected="selected" @endif value="{{ $loc['id']}}">{{ $loc['name']}}</option>
                  @endforeach
                </select>
            </div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label>Harga </label>
				<input type="text" id="product_price" name="product_price" placeholder="Ketikkan Harga " class="form-control" value="{{ $product['product_price'] ?? '' }}">
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
                <label>Type Diskon</label>
                <select class="form-control select2bs4" id="discount_type" name="discount_type" style="width: 100%;">
                  <option>---Pilih Type Diskon ---</option>
				  <option value=""> Tidak ada diskon </option>
                  <option value="percent"> Persen (%) </option>
				  <option value="fixed"> Nominal (Rp.) </option>
                </select>
            </div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label>Diskon</label>
				<input type="text" id="product_discount" name="product_discount" placeholder="Ketikkan Besaran Diskon " class="form-control" value="{{ $product['product_discount'] ?? '' }}">
			</div>
		</div>
		
	
         <div class="col-md-12 field_wrapper">
		<div>

			<input type="text"  class="form-attribute" placeholder="Nama Detail Harga Produk" name="price_detail[]" value=""/>
				<select class="form-attribute" id="customer_type" name="customer_type[]">
                  <option>---Pilih Type Pengguna ---</option>
				  <option value="umum"> Umum </option>
				  <option value="civitas"> Civitas </option>
				  <option value="mahasiswa"> Mahasiswa </option>
                </select>
	
				<input class="form-attribute" type="text"  placeholder="Harga" name="price[]" value=""/>
				<a href="javascript:void(0);" class="add_button btn btn-info btn-flat btn-sm" title="Add field">Tambah</a>
			</div>
		</div>

		
		<div class="col-md-6">
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
			</div>
		<div class="col-md-6">
              <div class="form-group">
                <label>Foto Slide</label>
                <input type="file" id="slide_images" multiple="" name="slide_images[]" placeholder="Input Foto" class="form-control" value="{{ $product['slide_images'] ?? '' }}">
                <br>
                @forelse($productSlide as $slide)
                <a target="_blank" href="{{ url('front/images/products/galery/'.$slide['image']) }}">
                  <img style="max-width:150px;" src="{{ asset('front/images/products/galery/'. $slide['image'])}}" alt=""></a>
                <a class="confirmDelete" href="javascript:void(0)" record="product-image-slide" recordid="{{ $slide['id'] }}" title="Hapus Foto Kategori"> <i class="fas fa-trash text-danger"></i> </a>
                <input type="hidden" name="current_slide_image[]" value="{{ $slide['image'] ?? '' }}[]" class="form-control">
                @empty
                @endforelse
            </div>
		 </div>
		
        <div class="col-md-6">
              <div class="form-group">
                <label>Fasilitas</label>
                <textarea name="product_facility" id="summernote" rows="3" placeholder="Ketikkan Fasilitas" class="form-control" value="{{ $product['product_facility'] ?? '' }}">{{ $product['product_facility'] ?? '' }}</textarea>
              </div>
		</div>
          <div class="col-md-6">
              <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="product_description" id="product_description" rows="3" placeholder="Ketikkan Deskripsi Halaman" class="form-control" value="{{ $product['description'] ?? '' }}"> {{ $product['product_description'] ?? ''}} </textarea>
              </div>
			  </div>
          <div class="col-md-6">
              <div class="form-group">
                <label>Judul Meta</label>
                <input type="text" id="meta_title" name="meta_title" placeholder="Ketikkan Judul Halaman" class="form-control" value="{{ $product['meta_title']  ?? '' }}">
              </div>
			  </div>
          <div class="col-md-6">
              <div class="form-group">
                <label>Deskripsi Meta</label>
                <textarea name="meta_description" id="meta_description" rows="3" placeholder="Ketikkan Deskripsi Halaman" class="form-control" value="{{ $product['meta_description'] ?? '' }}">{{ $product['meta_description'] ?? '' }}</textarea>
              </div>
			  </div>
          <div class="col-md-6">
              <div class="form-group">
                <label>Meta Pencarian</label>
                <input type="text" id="meta_keywords" name="meta_keywords" placeholder="Ketikkan Kata Kunci Meta Pencarian" class="form-control" value="{{ $product['meta_keywords'] ?? '' }}">
              </div>
			  </div>
          <div class="col-md-12">
              @if(empty($category['id']))
              <button type="submit" class="btn btn-primary">Simpan</button>
              @else
              <button type="submit" class="btn btn-info">Update</button>
              @endif
            </form>
          </div>
		  </div>
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
<script>
	$(document).ready(function() {
	
	// Add Product Attribute
    var maxField = 3; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><input type="text" class="form-attribute" name="price_detail[]" value=""/> <select class="form-attribute" id="customer_type" name="customer_type[]"><option>---Pilih Type Pengguna ---</option><option value="umum"> Umum </option><option value="civitas"> Civitas </option><option value="mahasiswa"> Mahasiswa </option></select> <input class="form-attribute" type="text" name="price[]" value=""/> <a href="javascript:void(0);" class="remove_button btn  btn-danger btn-flat btn-sm"> Hapus </a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    // Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increase field counter
            $(wrapper).append(fieldHTML); //Add field html
        }else{
            alert('A maximum of '+maxField+' fields are allowed to be added. ');
        }
    });
    
    // Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrease field counter
    });
	
});
</script>
@include('admin.partials._swalDeleteConfirm')
@endpush