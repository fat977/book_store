<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
          
          $adminsRecords = [
            [
                'id'=> 1,
                'name'=>'John',
                'mobile'=>'012147854123',
                'email'=>'john@admin.com',
                'password'=>'$2a$12$1vzXHan5H5udVpXz.BaMjOOCKvwdoKXQK2/bQZlRyRuV1VMD0tRyi',
                'image'=>'',
            ],
        ];
            Admin::insert($adminsRecords);
    }
}
