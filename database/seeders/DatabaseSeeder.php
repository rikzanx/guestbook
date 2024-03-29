<?php

namespace Database\Seeders;

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
        \App\Models\User::create([
                'name'    => "admin",
                'email'    => "admin". '@gmail.com',
                'password'    => bcrypt('admin123')
        ]);
        \App\Models\User::create([
                'name'    => "pos",
                'email'    => "pos". '@gmail.com',
                'password'    => bcrypt('pos123')
        ]);
    }
}
