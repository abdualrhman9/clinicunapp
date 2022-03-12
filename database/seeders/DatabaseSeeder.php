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
        // \App\Models\User::factory(10)->create();
        $roles = new RolesSeeder();
        $emails = new EmailSeeder();
        $users = new UserSeeder();
        $roles->run();
        $emails->run();
        $users->run();
    }
}
