<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
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
        $users = [
            'username' => 'navid',
            'password' => Hash::make('12345678'),
            'role' => 'Admin'
        ];
        $record = User::whereUsername($users['username'])->first();
        if (!$record) {
            $record = User::create($users);
        }
    }
}
