<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'first_name' => 'Luccas',
            'last_name' => 'Drapala',
            'email' => 'luccasdrapala@gmail.com',
            'password' => bcrypt('password1')
        ]);

        factory(User::class, 10)->create();
    }
}
