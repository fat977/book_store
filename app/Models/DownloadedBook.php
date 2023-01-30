<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Conner\Likeable\Likeable;

class DownloadedBook extends Model
{
    use HasFactory;
    protected $fillable = [
        'author_id','category_id','book_name','book_image','language','size','No_pages','file',
        'description','meta_title','meta_description','meta_keyword','status',
    ];

    public function authors(){
        return $this->belongsTo(Author::class,'author_id');
    }

    public function categories(){
        return $this->belongsTo(Category::class,'category_id')->select('id','category_name','status');
    }

      public function like(){
        return $this->hasMany(Like::class,'book_id');
    }
}
