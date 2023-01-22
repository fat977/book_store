<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    public function categories(){
        return $this->belongsTo(Category::class,'category_id')->select('id','category_name');
    }

    public static function authors(){
        $getAuthors = Author::where('status',1)->get()->toArray();
        return $getAuthors;
    }
   
}
