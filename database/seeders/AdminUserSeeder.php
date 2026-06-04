<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder {
    public function run(): void {
        User::updateOrCreate(
            ['email' => 'superadmin@travel.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('123456'),
                'role_id' => 1,
            ]
        );

        User::updateOrCreate(
            ['email' => 'admin@travel.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('123456'),
                'role_id' => 2,
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@travel.com'],
            [
                'name' => 'User',
                'password' => Hash::make('123456'),
                'role_id' => 3,
            ]
        );
    }
}
