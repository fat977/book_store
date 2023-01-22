<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public function authors(){
        return $this->hasMany(Author::class,'category_id')->select('id','name')->where('status',1);
    }

    public function books(){
        return $this->hasMany(Book::class,'category_id')->where('status',1)->get();
    }

    public static function categories(){
        $getCategories = Category::where('status',1)->select('category_name')->get()->toArray();
        //dd($getCategories);
        return $getCategories;
    } 

}
