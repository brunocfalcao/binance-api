<?php

namespace Nidavellir\Database\Seeders;

use Illuminate\Database\Seeder;
use Nidavellir\Cube\Models\User;

class InitialDataSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
    }
}
