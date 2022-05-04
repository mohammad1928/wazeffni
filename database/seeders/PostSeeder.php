<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('posts')->insert([
            'company_id'=>1,
           'job_title'=>Str::random(10),
           'category'=>Str::random(15),
           'city'=>Str::random(10),
           'description'=>Str::random(30),
           'requirements_skills'=>Str::random(20),
           'minSalary'=>200000,
           'maxSalary'=>400000,
           'created_at'=>new \DateTime(),
       ]);
    }
}
