<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAdminRequest;
use App\Http\Requests\ValidationRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /* public function __construct()
    {
        $this->middleware('admin');
    } 
    */
    public function loginView(){
        return view('admin.auth.login');
    }
    public function dashboard()
    {
        if(Auth::guard('admin')->check()){
            return view('admin.index');
        }else{
            return redirect('admin/login-view');
        }
        //return view('admin.index');
       
    }

    public function login(ValidationRequest $request){
      
        $data = $request->all();
    
        if(Auth::guard('admin')->attempt(['email' =>$data['email'],'password'=> $data['password']])){

            return redirect('admin/dashboard');
        }
        else{
            return redirect()->back()->with(['error_message' => 'invalid email or password']);
        }
     
    }

    public function updateDetails(Request $request){
        
        if($request->isMethod("post")){
            $request->validate([
                'name'=> 'required',
                'mobile' => 'required|starts_with:010,011,012|max:12',
                'image'=>  'image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100',
              
            ]);
            $data = $request->all();

            //upload images
    
             $image = $request->image;
             if(!empty($image)){
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $request->image->move('assets/admin/img',$imageName);
                Admin::where('id',Auth::guard('admin')->user()->id)->update(['image'=>$imageName]); 
             } 

             Admin::where('id',Auth::guard('admin')->user()->id)->update(['name'=>$data['name'],
            'mobile'=> $data['mobile']]); 
            return redirect('admin/update-details')->with(['success' =>'your data is updated successfully']);
          
        }
        $adminDetails = Admin::where('email',Auth::guard('admin')->user()->email)->first()->toArray(); 
        return view('admin.settings.update-details',compact('adminDetails'));
    }
  
    public function checkCurrentPassword(Request $request){
        $data = $request->all();
      
        if(Hash::check($data['current_password'],Auth::guard('admin')->user()->password)){
            return "true";
        } else{
            return "false";
        }
    }

    public function updatePassword(Request $request){

        if($request->isMethod("post")){
            $data = $request->all();
            $rules =[
                'new_password'=> ['required', 'string', 'min:8', 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[*-]).{6,}$/'],
                'confirm_password'=>['required']
            ];
            $message =[
            
            'new_password.required' => 'We need to know your new password!',
            ];
            $this->validate($request,$rules,$message);
            if(Hash::check($data['current_password'],Auth::guard('admin')->user()->password)){
                if($data['confirm_password']=== $data['new_password']){
                    Admin::where('id',Auth::guard('admin')->user()->id)->update(['password'
                    =>bcrypt($data['new_password'])]);

                    return redirect()->back()->with(['success' => 'Your password has been updated successfully']);
                
                 }else{
                return redirect()->back()->with(['error' => 'Your new password and confirmed password does not match']);
                }
            } else{
                return redirect()->back()->with(['error' => 'Your current password is incorrect']);
            } 
        }

        $adminDetails = Admin::where('email',Auth::guard('admin')->user()->email)->first()->toArray();
        return view('admin.settings.update-password',compact('adminDetails'));
    }

    public function deleteAdminImage($id){
        $admin_image = Admin::select('image')->where('id',$id)->first();
        $image_path = 'assets/admin/img/';
        if(file_exists($image_path.$admin_image->image)){
            unlink($image_path.$admin_image->image);
        }
        Admin::where('id',$id)->update(['image'=>'']);
        $message = "admin Image has been deleted successfully";
        return redirect()->back()->with(['success' => $message]);


    }

    public function logout(){
        Auth::guard('admin')->logout();
        return view ('admin.auth.login');
    }
}

