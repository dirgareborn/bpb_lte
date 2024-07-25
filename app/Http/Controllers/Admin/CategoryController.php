<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Intervention\Image\Laravel\Facades\Image;
use App\Models\AdminsRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class CategoryController extends Controller
{
    public function categories(){
        Session::put('page','categories');
        $categories = Category::with('parentcategory')->get()->toArray();

        //Set Admin/Subadmins Permissions 
        $categoriesModuleCount = AdminsRole::where(['admin_id'=>Auth::guard('admin')->user()->id,'module'=>'categories'])->count();
        $categoriesModule = [];
        if(Auth::guard('admin')->user()->type=="admin"){
            $categoriesModule['view_access']=1;
            $categoriesModule['edit_access']=1;
            $categoriesModule['full_access']=1;
        }else if($categoriesModuleCount == 0){
            $message = "This Featu is retriced for you!";
            return redirect('admin/dashboard')->with('error_message',$message);
        }else{
            $categoriesModule = AdminsRole::where(['admin_id'=>Auth::guard('admin')->user()->id,'module'=>'categories'])->first()->toArray();
        }
        return view('admin.categories.categories', compact('categories','categoriesModule'));
    }

    /**
     * Show the form for add and editing the specified resource.
     */
    public function edit(Request $request, $id=null)
    {
        // dd($id);
        $getCategories = Category::getCategories();
        if($id==""){
            $title = "Tambah Kategori";
            $category = new Category;
            $message = "Kategori berhasil ditambahkan";
        }else{
            $title = "Ubah Kategori";
            $category = Category::find($id);
            $message = "Kategori berhasil diperbaharui";
        }
        if($request->isMethod('post')){
            $data = $request->all();

            if($id==""){
                $categoryCount = Category::where('category_name', $data['category_name'])->count();
                if($categoryCount>0){
                    return redirect()->back()->with('error_message','Kategori '. $data['category_name'] . ' sudah ada !');
                }
            }
            if($id==""){
                $rules = [
                    'category_name' => 'required',
                    'url' => 'required|unique:categories',
                ];
            }else{
                $rules = [
                    'category_name' => 'required',
                    'url' => 'required'
                ];
            }
            $customMessages = [
                'category_name.required' => "Judul harus diisi",
                'url.required' => "URL harus diisi",
                'description.required' => 'Deskripsi harus diisi',
            ];

            $this->validate($request,$rules,$customMessages);

            if($request->hasFile('category_image')){
                $avatar = $request->file('category_image');
                $filename = time() . '.' . $avatar->getClientOriginalExtension();
                $image = Image::read($avatar);
                // Resize image
                $image->save(public_path('front/images/categories/' . $filename));
                $data['category_image'] = $filename;
                }else if (!empty($data['current_image'])){
                    $data['category_image'] = $data['current_image'];
                }else{
                    $data['category_image'] = "";
                }
                $category->category_name = $data['category_name'];
                $category->category_image = $data['category_image'];
                $category->category_discount = $data['category_discount'] ?? 0;
                $category->url = $data['url'];
                $category->parent_id = $data['parent_id'] ?? 0;
                $category->description = $data['description'];
                $category->meta_title = $data['meta_title'];
                $category->meta_description = $data['meta_description'];
                $category->meta_keywords = $data['meta_keywords'];
                $category->status = 1;
                $category->save();

            return redirect('admin/categories')->with('success_message',$message);
        }
    
        return view('admin.categories.add_edit_category')->with(compact('title','category','getCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStatus(Request $request, Category $category)
    {
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            Category::where('id',$data['category_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'category_id'=>$data['category_id']]);
        }
    }

    public function deleteCategory($id)
    {
        Category::where('id',$id)->delete();
        return redirect()->back()->with('success_message','Kategori Berhasil dihapus');
    }
    public function deleteCategoryImage($id)
    {
        $categoryImage = Category::select('category_image')->where('id',$id)->first();
        $category_image_path = 'front/images/categories/';
        if(file_exists($category_image_path.$categoryImage->category_image)){
            unlink($category_image_path.$categoryImage->category_image);
        }
        Category::where('id',$id)->update(['category_image'=>'']);
        return redirect()->back()->with('success_message','Foto Kategori  Berhasil dihapus');
    }
}
