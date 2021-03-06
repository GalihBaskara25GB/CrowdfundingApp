
<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'id' => Str::uuid()->toString(),
                'role' => 'user',
            ],
            [
                'id' => Str::uuid()->toString(),
                'role' => 'admin',
            ]
        ]);
    }
}