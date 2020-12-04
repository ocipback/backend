<?php

namespace Database\Seeders;

use App\Models\Opportunity;
use App\Models\OpportunityDetail;
use Faker\Factory;
use Illuminate\Database\Seeder;

class OpportunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // // \App\Models\User::factory(10)->create();
        // \App\Models\Opportunity::factory(300)->create()->each(function ($opportunity) {
        //     $opportunity->detail()->save(factory(OpportunityDetail::class)->make());
        // });
        Opportunity::factory(300)->create()->each(function ($opportunity) {
            $opportunity->detail()->save(OpportunityDetail::factory()->make());
        });
    }
}
