<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Daftar permissions
        $permissions = [
            'manage statistics',
            'manage products',
            'manage principles',
            'manage testimonials',
            'manage clients',
            'manage teams',
            'manage about',
            'manage appointments',
            'manage hero sections',
            'manage projects',

        ];

        // Buat permissions jika belum ada
        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission
            ]);
        }

        // Buat roles
        $superAdminRole = Role::firstOrCreate(['name' => 'super_admin']);
        $ownerRole = Role::firstOrCreate(['name' => 'owner']);
        $pekerjaRole = Role::firstOrCreate(['name' => 'pekerja']);

        // Berikan semua permission ke super_admin
        $superAdminRole->syncPermissions($permissions);

        // // Misal owner hanya dapat manage products & clients
        // $ownerRole->syncPermissions(['manage products', 'manage clients']);

        // // Pekerja bisa diberi permission lebih terbatas, misal manage appointments
        // $pekerjaRole->syncPermissions(['manage appointments']);

        // Buat user super admin
        $superAdminUser = User::firstOrCreate(
            ['email' => 'wahyu@gmail.com'],
            [
                'name' => 'Wahyu',
                'password' => bcrypt('password'),
            ]
        );
        $superAdminUser->assignRole($superAdminRole);

        // // Contoh buat user owner
        // $ownerUser = User::firstOrCreate(
        //     ['email' => 'owner@gmail.com'],
        //     [
        //         'name' => 'Owner Example',
        //         'password' => bcrypt('password'),
        //     ]
        // );
        // $ownerUser->assignRole($ownerRole);

        // // Contoh buat user pekerja
        // $pekerjaUser = User::firstOrCreate(
        //     ['email' => 'pekerja@gmail.com'],
        //     [
        //         'name' => 'Pekerja Example',
        //         'password' => bcrypt('password'),
        //     ]
        // );
        // $pekerjaUser->assignRole($pekerjaRole);
    }
}
