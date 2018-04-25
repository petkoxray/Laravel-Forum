<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Role;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $adminRole = Role::create([
            'name' => 'admin'
        ]);

        $userRole = Role::create([
            'name' => 'user'
        ]);

        User::create([
            'name' => "Admin Adminov",
            'email' => "admin@abv.bg",
            'password' => Hash::make("123456"),
            'confirmed' => true
        ])->assignRole($adminRole);

        User::create([
            'name' => "Pesho Peshev",
            'email' => "pesho@abv.bg",
            'password' => Hash::make("123456"),
            'confirmed' => true
        ])->assignRole($userRole);
    }
}
