<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AdminsRole;
use Intervention\Image\Laravel\Facades\Image;
use App\Models\Category;
use Illuminate\Support\Facades\Session;
use App\Models\Location;
use App\Models\ProductsImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function products()
    {
        $title = "Produk";
        $products = Product::with(['locations','categories'])->get()->toArray();

        //Set Admin/Subadmins Permissions 
        $productsModuleCount = AdminsRole::where(['admin_id'=>Auth::guard('admin')->user()->id,'module'=>'products'])->count();
        $productModule = [];
        if(Auth::guard('admin')->user()->type=="admin"){
            $productModule['view_access']=1;
            $productModule['edit_access']=1;
            $productModule['full_access']=1;
        }else if($productsModuleCount == 0){
            $message = "This Featu is retriced for you!";
            return redirect('admin/dashboard')->with('error_message',$message);
        }else{
            $productModule = AdminsRole::where(['admin_id'=>Auth::guard('admin')->user()->id,'module'=>'products'])->first()->toArray();
        }        
        return view('admin.products.products')->with(compact('title','products','productModule'));
    }

    /**
     * Update Status Product the specified resource in storage.
     */
    public function updateStatus(Request $request, Product $product)
    {
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            Product::where('id',$data['product_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'product_id'=>$data['product_id']]);
        }
    }

    public function deleteProduct($id)
    {
        Product::where('id',$id)->delete();
        return redirect()->back()->with('success_message','Produk Berhasil dihapus');
    }
    public function deleteProductImage($id)
    {
        $productImage = Product::select('product_image')->where('id',$id)->first();
        $product_image_path = 'front/images/products/';
        if(file_exists($product_image_path.$productImage->product_image)){
            unlink($product_image_path.$productImage->product_image);
        }
        Product::where('id',$id)->update(['product_image'=>'']);
        return redirect()->back()->with('success_message','Foto Produk  Berhasil dihapus');
    }
    public function deleteProductImageSlide($id)
    {
        $productImage = ProductsImage::select('image')->where('id',$id)->first();
        $product_image_path = 'front/images/products/galery/';
        if(file_exists($product_image_path.$productImage->image)){
            unlink($product_image_path.$productImage->image);
        }
        ProductsImage::where('id',$id)->update(['image'=>'']);
        return redirect()->back()->with('success_message','Foto Produk  Berhasil dihapus');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id=null)
    {
        // dd($request);
        $getCategories = Category::getCategories();
        $getLocations  = Location::All();

        if($id==""){
            $title = "Tambah Produk";
            $product = new Product;
            $message = "Produk berhasil ditambahkan";
            $productSlide = ProductsImage::where('product_id',$id)->get();
        }else{
            $title = "Ubah Produk";
            $product = Product::find($id);
            $productSlide = ProductsImage::where('product_id',$id)->get();
            // dd($productSlide);
            $message = "Produk berhasil diperbaharui";
        }
        if($request->isMethod('post')){
            $data = $request->all();
            // dd($data['product_price']);
            if($id==""){
                $productCount = Product::where('product_name', $data['product_name'])->count();
                if($productCount>0){
                    return redirect()->back()->with('error_message','Produk '. $data['product_name'] . ' sudah ada !');
                }
            }
            if($id==""){
                $rules = [
                    'category_id' => 'required',
                    // 'product_name' => 'required|regex:/^[pL\s\-]+$/u|max:200',
                    'product_price' => 'required',
                    // 'url' => 'required|unique:products',
                ];
            }else{
                $rules = [
                    'category_id.required' => 'Kategoru harus diisi',
                    'product_name.required' => 'Nama Produk harus diisi',
                    // 'url' => 'required'
                ];
            }
            $customMessages = [
                'product_name.required' => "Judul harus diisi",
                // 'product_name.regex' =>  "Nama Produk Harus Valid",
                'product_price.required' =>  "Harga Produk Harus diisi",
                'description.required' => 'Deskripsi harus diisi',
            ];

            $this->validate($request,$rules,$customMessages);

            if($request->hasFile('cover_image')){
                $avatar = $request->file('cover_image');
                $filename = time() . '.' . $avatar->getClientOriginalExtension();
                $image = Image::read($avatar);
                // Resize image
                $image->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('front/images/products/' . $filename));
                $data['product_image'] = $filename;
                }else if (!empty($data['current_image'])){
                    $data['product_image'] = $data['current_image'];
                }else{
                    $data['product_image'] = "";
                }
                $product->category_id = $data['category_id'];
                $product->location_id = $data['location_id'];
                $product->product_name = $data['product_name'];
                $product->product_facility = $data['product_facility'];
                $product->product_price = $data['product_price'];
                $product->product_image = $data['product_image'];
                $product->location_id = $data['location_id'];
                $product->product_description = $data['product_description'];
                $product->meta_title = $data['meta_title'];
                $product->meta_description = $data['meta_description'];
                $product->meta_keywords = $data['meta_keywords'];
                $product->status = 1;
                $product->save();
                if($id==""){
                    $product_id = DB::getPdo()->lastInsertId();
                }else{
                    $product_id = $id;
                }

                // dd($request->slide_images);
                // Upload Product Images
                if($request->hasFile('slide_images')){
                    $images = $request->file('slide_images');
                    foreach($images as $file){
                        $filename = $file->getClientOriginalName();
                        $extension = $file->getClientOriginalExtension();
                        $fileName = str::random(5)."-".date('his')."-".str::random(3).".".$extension;
                        
                        $destinationPath = 'front/images/products/galery'.'/';
                        $file->move($destinationPath, $fileName);

                        $image = new ProductsImage;
                        $image->product_id  = $product_id;
                        $image->image       = $fileName;
                        $image->image_sort        = 0;
                        $image->status      = 1;
                        $image->save();
                    }
                }
            return redirect('admin/products')->with('success_message',$message);
        }
        return view('admin.products.add_edit_product')->with(compact('title','product','getCategories','getLocations','productSlide'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
