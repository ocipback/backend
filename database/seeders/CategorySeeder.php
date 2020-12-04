<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //\App\Models\User::factory(10)->create();
        DB::table('categories')->insert([
            [
                'name' => 'Sekolah'
            ],
            [
                'name' => 'Filosofi'
            ],
            [
                'name' => 'Internship'
            ]
        ]);
    }
}
