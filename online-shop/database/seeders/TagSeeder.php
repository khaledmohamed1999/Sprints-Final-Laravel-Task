<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('tags')->insert(['name' => 'Clothes', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('tags')->insert(['name' => 'Office', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('tags')->insert(['name' => 'Electronics', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('tags')->insert(['name' => 'Care', 'created_at' => now(), 'updated_at' => now()]);
    }
}
