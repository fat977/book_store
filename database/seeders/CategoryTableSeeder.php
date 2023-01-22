<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $categoriesRecords = [
            ['id'=>1,
             'category_name'=>'Horror',
             'description'=>'',
             'url'=>'horror',
             'meta_title'=>'',
             'meta_description'=>'',
             'meta_keywords'=>'',  
             'status'=>1         
            ],
            ['id'=>2,
            'category_name'=>'Romantic',
            'description'=>'',
            'url'=>'romantic',
            'meta_title'=>'',
            'meta_description'=>'',
            'meta_keywords'=>'',  
            'status'=>1         
           ],
           ['id'=>3,
           'category_name'=>'Action',
           'description'=>'',
           'url'=>'action',
           'meta_title'=>'',
           'meta_description'=>'',
           'meta_keywords'=>'',
           'status'=>1           
          ],
           
        ];
        Category::insert($categoriesRecords);
    }
}
