<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function categories(){
        $categories = Category::get()->toArray();
        //dd($categories);
        return view('admin.categories.categories',compact('categories'));
    }

    public function updateCategoryStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status']=='active'){
                $status = 0;
            }else{
                $status=1;
            }
            Category::where('id',$data['category_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'category_id'=>$data['category_id']]);
        }
    }

    public function deleteCategory($id){
        Category::where('id',$id)->delete();
        
        $message = "category has been deleted successfully";
        return redirect()->back()->with(['success' => $message]);

    }

    public function AddEditCategory(Request $request,$id=null){
        if($id==""){
            $title = "Add new Category";
            $category = new Category;
            $message = "Category is added successfully";
        }else{
            $title = "Edit category";
            $category = Category::find($id);
            $message = "Category is updated successfully";
        }
        if($request->isMethod('post')){
            $request->validate([
                'category_name'=> 'required',             
            ]);
            $data = $request->all();
           /*  $rules= [
                //
                'category_name' => 'required',
            ];
            $message =[
                'category_name.required' => 'name is required!',
            ];

            $this->validate($request,$rules,$message); */

            $category->category_name =$data['category_name'];
            $category->description = $data['description'];
            $category->url = $data['url'];
            $category->meta_title = $data['meta_title'];
            $category->meta_description = $data['meta_description'];
            $category->meta_keywords = $data['meta_keywords'];
            $category->status=1;
            $category->save();

            return redirect('admin/categories')->with(['success' => $message]);
        }
        return view('admin.categories.add-edit-category',compact('title','category'));

    }
}
