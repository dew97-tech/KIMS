<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Generate Admin user

        $newUser = User::create([
            'name' => 'Admin',
            'email' => 'admin@bopinc.com',
            'phone' => '1234',
            'password' => Hash::make('@Dm!nB0p!Nc'),
        ]);

        $newUser->assignRole('admin');
    }
}
