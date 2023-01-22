<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $booksRecords = [
            ['id'=>1,
             'author_id'=>1,
             'category_id'=>1,
             'book_name'=>'Half Dead',
             'book_price'=>100,
             'book_discount'=>10,
             'book_image'=>'',
             'description'=>'',
             'meta_title'=>'',
             'meta_description'=>'',
             'meta_keywords'=>'', 
             'is_bestseller'=>'Yes', 
             'status'=>1         
            ],
            ['id'=>2,
             'author_id'=>3,
             'category_id'=>2,
             'book_name'=>'Ezma',
             'book_price'=>120,
             'book_discount'=>15,
             'book_image'=>'',
             'description'=>'',
             'meta_title'=>'',
             'meta_description'=>'',
             'meta_keywords'=>'', 
             'is_bestseller'=>'Yes', 
            'status'=>1         
           ],
        ];

        Book::insert($booksRecords);
    }
}
