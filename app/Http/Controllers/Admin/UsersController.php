<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //
    public function users(){
        $users = User::all();
        return view('admin.users.users',compact('users'));
    }

    public function viewUsers($id){
        $users = User::find($id);
        return view('admin.users.view_users',compact('users'));
    }
}
