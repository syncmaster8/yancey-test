<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'name'                          => 'Admin',
            'username'                      => 'Super.Admin',
            'password'                      => bcrypt('testpasswordadmin21'),
            'type_id'                       => 1,
            'store_id'                      => null
        ]);

        User::create([
            'name'                          => 'Manager',
            'username'                      => 'Mall.Manager',
            'password'                      => bcrypt('testpasswordmanager21'),
            'type_id'                       => 2,
            'store_id'                      => null
        ]);

        User::create([
            'name'                          => 'Owner',
            'username'                      => 'Store.Owner',
            'password'                      => bcrypt('testpasswordstore21'),
            'type_id'                       => 3,
            'store_id'                      => 1
        ]);

    }
}
