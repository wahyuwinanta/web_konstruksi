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
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                [
                    'name' => $permission
                ]
             );
        }

        $superAdminRole = Role::firstOrCreate([
                'name' => 'super_admin'
        ]);
        
        $user = User::create([
                'name' => 'Wahyu',
                'email' => 'wahyu@gmail.com',
                'password' => bcrypt('password')
            ]);

        $user->assignRole($superAdminRole);

        $ownerRole = Role::firstOrCreate([
            'name' => 'owner'
        ]);

        $owner = User::firstOrCreate([
            'name' => 'Owner',
            'email' => 'owner@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $owner->assignRole($ownerRole);

        $pekerjaRole = Role::firstOrCreate([
            'name' => 'pekerja'
        ]);

        $pekerja = User::firstOrCreate([
        'name' => 'Pekerja',
        'email' => 'pekerja@gmail.com',
        'password' => bcrypt('password'),
        ]);

        $pekerja->assignRole($pekerjaRole);
    }
}