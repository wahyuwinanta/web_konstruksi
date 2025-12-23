<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class PekerjaUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pekerjaRole = Role::where('name', 'pekerja')->first();

        $pekerjaNames = [
            'Nurdin',
            'Sapnan',
            'Rudiansyah',
            'Ade Mulyana',
            'Dedi',
            'Tata',
            'Bukhori',
            'Karmani',
            'Wawan',
            'Heri',
            'Emot',
            'Nunu',
            'Ero',
            'Rudi',
            'Entris',
            'Adam',
            'Hendriyanto',
            'Agus',
            'Madrohim',
            'Mitra',
            'Arman',
            'Zaelani',
            'Arif',
            'Tono',
            'Yana',
            'Yanto',
        ];

        foreach ($pekerjaNames as $name) {
            $email = Str::slug($name, '') . '@muliamandiri.test';

            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => $name,
                    'password' => bcrypt('password'),
                ]
            );

            if (! $user->hasRole('pekerja')) {
                $user->assignRole($pekerjaRole);
            }
        }
    }
}
