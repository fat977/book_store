<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Category;
use App\Models\DownloadedBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookDownloadController extends Controller
{
    //
    public function books_downloaded(){
        $books =DownloadedBook::with(['authors'=>function($query){
            $query->select('id','name');
        },'categories'=>function($query){
            $query->select('id','category_name','status');
        }]);
        $books= $books->get()->toArray();
       return view('admin.books-downloaded.books',compact('books'));
    } 

    public function updateBookStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status']=='active'){
                $status = 0;
            }else{
                $status=1;
            }
            DownloadedBook::where('id',$data['book_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'book_id'=>$data['book_id']]);
        }
    }

    public function addEditBook_downloaded(Request $request,$id=null){
        if($id==""){
            $title = "Add new Book";
            $book = new DownloadedBook;
            $message = "Book is added successfully";
        }else{
            $title = "Edit Book";
            $book = DownloadedBook::find($id);
            $message = "Book is updated successfully";
        }
        if($request->isMethod('post')){
            $request->validate([
                'author_id'=>'required',
                'category_id'=>'required',
                'book_name'=> 'required',
                'file'=>'required|max:10000',
                'book_image'=>  'image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100',
              
            ]);
            $data = $request->all();
            //upload image
            if($request->hasFile('book_image')){
                $image_tmp = $request->file('book_image');
                   //Upload image 
                if($image_tmp->isValid()){
                    $book_image = $request->book_image;
                    if(!empty($book_image)){
                        $imageName = time().'.'.$book_image->getClientOriginalExtension();
                        $request->book_image->move('assets/admin/img/books/',$imageName);
                    }
                    $book->book_image = $imageName;
                }
            }

             //upload file
             if($request->hasFile('file')){
                $file_tmp = $request->file('file');
                   //Upload image 
                if($file_tmp->isValid()){
                    $file = $request->file;
                    if(!empty($file)){
                        $file_name = time().'.'.$file->getClientOriginalExtension();
                        $request->file->move('assets/admin/downloads/',$file_name);
                    }
                    $book->file = $file_name;
                }
            }
         
             // save  book details
            $book->author_id =$data['author_id'];
            $book->category_id =$data['category_id'];     
          
            $admin_id = Auth::guard('admin')->user()->id;

            $book->book_name = $data['book_name'];
            $book->language = $data['language'];
            $book->size = $data['size'];
            $book->No_pages = $data['No_pages'];        
            $book->description = $data['description'];          
            $book->meta_title = $data['meta_title'];
            $book->meta_description = $data['meta_description'];
            $book->meta_keywords = $data['meta_keywords'];
            $book->status = 1;
            $book->save();

            return redirect('admin/books-downloaded')->with(['success' => $message]);

        }

       // get authors  with categories 
       $categories = Category::where('status',1)->get();
       $authors = Author::where('status',1)->get();

        return view('admin.books-downloaded.add-edit-book',compact('title','authors','categories','book'));

    }

    public function deleteBookImage($id){
        $book_image = DownloadedBook::select('book_image')->where('id',$id)->first();
        $image_path = 'assets/admin/img/books/';
        if(file_exists($image_path.$book_image->book_image)){
            unlink($image_path.$book_image->book_image);
        }
        DownloadedBook::where('id',$id)->update(['book_image'=>'']);
        $message = "Book Image has been deleted successfully";
        return redirect()->back()->with(['success' => $message]);


    }

    public function deleteBook($id){
        DownloadedBook::where('id',$id)->delete();
        $message = "Book has been deleted successfully";
        return redirect()->back()->with(['success' => $message]);

    }
}
