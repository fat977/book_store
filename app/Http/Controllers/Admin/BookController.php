<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    //
    public function books(){
        $books =Book::with(['authors'=>function($query){
            $query->select('id','name');
        },'categories'=>function($query){
            $query->select('id','category_name','status');
        }]);
        $books= $books->get()->toArray();
       return view('admin.books.books',compact('books'));
    } 

    public function updateBookStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status']=='active'){
                $status = 0;
            }else{
                $status=1;
            }
            Book::where('id',$data['book_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'book_id'=>$data['book_id']]);
        }
    }

    public function addEditBook(Request $request,$id=null){
        if($id==""){
            $title = "Add new Book";
            $book = new Book;
            $message = "Book is added successfully";
        }else{
            $title = "Edit Book";
            $book = Book::find($id);
            $message = "Book is updated successfully";
        }
        if($request->isMethod('post')){
            $request->validate([
                'author_id'=>'required',
                'category_id'=>'required',
                'book_name'=> 'required',
                'book_price'=>'required',
                'book_image'=>  'image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100',
              
            ]);
            $data = $request->all();
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
         
             // save  book details
            $book->author_id =$data['author_id'];
            $book->category_id =$data['category_id'];     
          
            $admin_id = Auth::guard('admin')->user()->id;

            $book->book_name = $data['book_name'];
            $book->book_price = $data['book_price'];
            $book->book_discount = $data['book_discount'];
            $book->description = $data['description'];
            $book->stock = $data['stock'];
            $book->date = $data['date'];
            $book->meta_title = $data['meta_title'];
            $book->meta_description = $data['meta_description'];
            $book->meta_keywords = $data['meta_keywords'];

            if(!empty($data['is_bestseller'])){
                $book->is_bestseller =$data['is_bestseller'];
            }else{
                $book->is_bestseller ="No";
            }

            if(empty($data['book_discount'])){
                $book->book_discount =0;
            }
          
            $book->status = 1;
            $book->save();

            return redirect('admin/books')->with(['success' => $message]);

        }

       // get authors  with categories 
       $categories = Category::where('status',1)->get();
       $authors = Author::where('status',1)->get();

        return view('admin.books.add-edit-book',compact('title','authors','categories','book'));

    }

    public function deleteBookImage($id){
        $book_image = Book::select('book_image')->where('id',$id)->first();
        $image_path = 'assets/admin/img/books/';
        if(file_exists($image_path.$book_image->book_image)){
            unlink($image_path.$book_image->book_image);
        }
        Book::where('id',$id)->update(['book_image'=>'']);
        $message = "Book Image has been deleted successfully";
        return redirect()->back()->with(['success' => $message]);


    }

    public function deleteBook($id){
        Book::where('id',$id)->delete();
        $message = "Book has been deleted successfully";
        return redirect()->back()->with(['success' => $message]);

    }
}
