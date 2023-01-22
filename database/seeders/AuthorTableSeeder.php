<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $authorsRecords = [
            ['id'=>1,'name'=>'Hassan ElGendy','category_id'=>1,'bio'=>'','status'=>1],
            ['id'=>2,'name'=>'Hussein ElSayed','category_id'=>1,'bio'=>'','status'=>1],
            ['id'=>3,'name'=>'Mohammed Sadek','category_id'=>2,'bio'=>'','status'=>1],
        ];
        Author::insert($authorsRecords);
    }
}
