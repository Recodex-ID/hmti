<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersAndRolesSeeder extends Seeder
{
    public function run(): void
    {
        // Create roles
        $roles = [
            'Super Admin',
            'Admin',
            'Kahim',
            'Wakahim',
            'Kadep',
        ];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        // Create Super Admin
        $superAdmin = User::create([
            'name' => 'Zachran Razendra',
            'username' => 'zachranraze',
            'email' => 'zachranraze@recodex.id',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
        ]);
        $superAdmin->assignRole('Super Admin');

        // Create Admin
        $admin = User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@hmtitelkomuniversity.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
        ]);
        $admin->assignRole('Admin');

        // Create Kahim (Ketua Himpunan)
        $kahim = User::create([
            'name' => 'Ketua Himpunan',
            'username' => 'kahim',
            'email' => 'kahim@hmtitelkomuniversity.com',
            'email_verified_at' => now(),
            'password' => Hash::make('kahim123'),
        ]);
        $kahim->assignRole('Kahim');

        // Create Wakahim (Wakil Ketua Himpunan)
        $wakahim = User::create([
            'name' => 'Wakil Ketua Himpunan',
            'username' => 'wakahim',
            'email' => 'wakahim@hmtitelkomuniversity.com',
            'email_verified_at' => now(),
            'password' => Hash::make('wakahim123'),
        ]);
        $wakahim->assignRole('Wakahim');

        // Create Kadep (Kepala Departemen)
        $kadep = User::create([
            'name' => 'Kepala Departemen',
            'username' => 'kadep',
            'email' => 'kadep@hmtitelkomuniversity.com',
            'email_verified_at' => now(),
            'password' => Hash::make('kadep123'),
        ]);
        $kadep->assignRole('Kadep');
    }
}
