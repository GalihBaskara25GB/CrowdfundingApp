<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CampaignsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Campaign::class, 15)->create();
    }
}
