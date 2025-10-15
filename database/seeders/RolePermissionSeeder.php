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

        $designManagerRole = Role::firstOrCreate([
                'name' => 'designer_manager'
        ]);

        $designManagerPermissions = [
            'manage products',
            'manage principles',
            'manage testimonials',
        ];

        $designManagerRole->syncPermissions($designManagerPermissions);

        $superAdminRole = Role::firstOrCreate([
                'name' => 'super_admin'
        ]);
        
        $user = User::create([
                'name' => 'Wahyu',
                'email' => 'wahyu@gmail.com',
                'password' => bcrypt('password')
            ]);

        $user->assignRole($superAdminRole);
    }
}