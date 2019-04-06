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
        $user = new User;
        $user->name = "admin";
        $user->email = 'admin@test.com';
        $user->username = "admin";
        $user->password = Hash::make('admin123');
        $user->email_verified_at = now();
        $user->save();
    }
}
