<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    //
    public function authors(){
        $authors = Author::with('categories')->get();
       // dd($authors);
       return view('admin.authors.authors',compact('authors'));
    }

    public function updateAuthorStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status']=='active'){
                $status = 0;
            }else{
                $status=1;
            }
            Author::where('id',$data['author_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'author_id'=>$data['author_id']]);
        }
    }

    public function addEditAuthor(Request $request,$id=null){
        if($id==""){
            $title = "Add new Author";
            $author = new Author();
            $message = "Author is added successfully";
        }else{
            $title = "Edit Author";
            $author = Author::find($id);
            $message = "Author is updated successfully";
        }
        if($request->isMethod('post')){
            /*  $rules= [
                //
                'name' => 'required|max:255',
                'image'=>  'required|image|mimes:jpg,png,jpeg,gif,svg|dimensions:min_width=10,min_height=10',
                'bio' => 'required'
            ];
            $message =[
                'name.required' => 'name is required!',
            ];

            $this->validate($request,$rules,$message); */
            $request->validate([
                'name'=> 'required',
                'category_id'=>'required',
                'bio'=>'required',
                'image'=>  'image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100',
              
            ]);
            $data = $request->all();
            $image = $request->image;
            if(!empty($image)){
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $request->image->move('assets/admin/img/authors/',$imageName);
            } 
           

            $author->category_id = $data['category_id'];
            $author->name =$data['name'];
            $author->bio = $data['bio'];
            if(!empty($image)){
                $author->image = $imageName;
            }
            $author->status = 1;
            $author->save();

            return redirect('admin/authors')->with(['success' => $message]);
        }
        $getCategories = Category::get()->toArray();
        return view('admin.authors.add-edit-author',compact('title','author','getCategories'));

    }

    public function deleteAuthor($id){
        Author::where('id',$id)->delete();
        $message = "Author has been deleted successfully";
        return redirect()->back()->with(['success' => $message]);

    }
}
