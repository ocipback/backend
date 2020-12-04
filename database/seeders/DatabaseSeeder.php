<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Question;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(CategorySeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(UserSeeder::class);
        $this->call(OpportunitySeeder::class);
        $this->call(QuestionSeeder::class);
        $this->call(CommentSeeder::class);
    }
}
