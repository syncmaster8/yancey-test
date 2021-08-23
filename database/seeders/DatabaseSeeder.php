<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Visitor;
use App\Models\Store;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Visitor::factory(100)->create();
        Store::factory(30)->create();

        $this->call([
            UserTypeSeeder::class,
            UserSeeder::class
        ]);
    }
}
