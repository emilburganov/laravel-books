<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $roles = ['Пользователь', 'Админ'];

        foreach ($roles as $role) {
            Role::query()->create([
                'name' => $role,
            ]);
        }

        User::query()->create([
            'login' => 'emil',
            'password' => Hash::make('/signin'),
            'role_id' => 2,
        ]);
    }
}
