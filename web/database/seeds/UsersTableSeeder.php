<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'vitolinseriks@gmail.com')->first();

        if (!$user) {
            User::create([
                'name' => 'Eriks Vītolīņs',
                'email' => 'vitolinseriks@gmail.com',
                'password' => Hash::make('Vitolins77'),
                'role' => 'admin'
                ]);
        }
    }
}
