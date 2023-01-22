<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_id',
        'book_id',
        'user_review',
        'stars_rated'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

   /*  public function rating(){
        return $this->belongsTo(Rating::class,'user_id','user_id');
    } */

    public function book(){
        return $this->belongsTo(Book::class,'book_id');
    }
}
