<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('marcas')->insert(['nome' => 'Electrolux']);
        DB::table('marcas')->insert(['nome' => 'Brastemp']);
        DB::table('marcas')->insert(['nome' => 'Fischer']);
        DB::table('marcas')->insert(['nome' => 'Samsung']);
        DB::table('marcas')->insert(['nome' => 'LG']);
    }
}
