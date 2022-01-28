<?php

namespace Database\Seeders;

use App\Models\Email;
use Illuminate\Database\Seeder;

class EmailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Email::truncate();
        Email::create([
            'email'=>'abdoalrhman9@hotmail.com',
            'role'=>1,
        ]);

        Email::create([
            'email'=>'doctor1@email.com',
            'role'=>3,
        ]);

    }
}
