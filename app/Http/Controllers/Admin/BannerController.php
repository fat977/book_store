<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    //
    public function banners(){
        $banners = Banner::get()->toArray();
        return view('admin.banners.banners',compact('banners'));
    }

    public function updateBannerStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status']=='active'){
                $status = 0;
            }else{
                $status=1;
            }
            Banner::where('id',$data['banner_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'banner_id'=>$data['banner_id']]);
        }

    }

    public function deleteBanner($id){
        $banner_image = Banner::where('id',$id)->first();
        $image_path = 'front/images/banners/';
        if(file_exists($image_path.$banner_image->image)){
            unlink($image_path.$banner_image->image);
        }
        Banner::where('id',$id)->delete();
        $message = "Banner has been deleted successfully";
        return redirect('admin/banners')->with(['success' => $message]);


    }

    public function deleteBannerImage($id){
        $image = Banner::select('image')->where('id',$id)->first();
        $image_path = 'assets/front/images/banners/';
        if(file_exists($image_path.$image->image)){
            unlink($image_path.$image->image);
        }
        Banner::where('id',$id)->update(['image'=>'']);
        $message = "Book Image has been deleted successfully";
        return redirect()->back()->with(['success' => $message]);


    }

    public function addEditBanner(Request $request , $id=null){
        if($id==""){
            $title = "Add new banner";
            $banner = new Banner;
            $message = "Banner is added successfully";
        }else{
            $title = "Edit Banner";
            $banner = Banner::find($id);
            $message = "Banner is updated successfully";
        }
        if($request->isMethod('post')){
            $request->validate([
                'link'=> 'required',
                'title'=>'required',
                'alt'=>'required',
                'image'=>  'image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100',
              
            ]);
            $data = $request->all();

            if($request->hasFile('image')){
                $image_tmp = $request->file('image');
                   //Upload image 
                if($image_tmp->isValid()){
                    // Insert Image Name in products table
                $banner_image = $request->image;
                if(!empty($banner_image)){
                    $imageName = time().'.'.$banner_image->getClientOriginalExtension();
                    $request->image->move('assets/front/images/banners',$imageName);
                 }
                $banner->image = $imageName;
                }
            }

            $banner->link = $data['link'];
            $banner->title = $data['title'];
            $banner->alt = $data['alt'];
            $banner->status = 1;
            $banner->save();

            $message = "Banner has been updated successfully";
            return redirect('admin/banners')->with(['success' => $message]);
    
        }

        return view('admin.banners.add-edit-banner',compact('banner','title'));


    }
}
