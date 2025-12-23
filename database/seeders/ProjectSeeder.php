<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use App\Models\ProjectAssignment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil 1 owner sebagai pembuat proyek
        $owner = User::role('owner')->first();

        if (!$owner) {
            $this->command->warn('Owner tidak ditemukan, project seeder dilewati.');
            return;
        }

        // Ambil semua pekerja aktif
        $workers = User::role('pekerja')->where('is_active', 1)->get();

        if ($workers->isEmpty()) {
            $this->command->warn('Pekerja tidak ditemukan, project seeder dilewati.');
            return;
        }

        $projects = [
            [
                'project_name'   => 'Pembangunan Rumah Tinggal Bandung',
                'location'       => 'Bandung',
                'project_type'   => 'Rumah Tinggal',
                'status'         => 'on_progress',
            ],
            [
                'project_name'   => 'Renovasi Kantor CV Mulia Mandiri',
                'location'       => 'Cirebon',
                'project_type'   => 'Renovasi',
                'status'         => 'pending',
            ],
            [
                'project_name'   => 'Pembangunan Gudang Logistik',
                'location'       => 'Majalengka',
                'project_type'   => 'Gudang',
                'status'         => 'on_progress',
            ],
            [
                'project_name'   => 'Perbaikan Jalan Lingkungan',
                'location'       => 'Kuningan',
                'project_type'   => 'Infrastruktur',
                'status'         => 'completed',
            ],
        ];

        DB::transaction(function () use ($projects, $owner, $workers) {

            foreach ($projects as $data) {

                $project = Project::create([
                    'project_name'   => $data['project_name'],
                    'description'    => 'Proyek hasil seeding untuk testing sistem.',
                    'location'       => $data['location'],
                    'project_type'   => $data['project_type'],
                    'start_date'     => Carbon::now()->subDays(rand(10, 60)),
                    'end_date'       => rand(0, 1) ? Carbon::now()->addDays(rand(30, 90)) : null,
                    'status'         => $data['status'],
                    'estimated_cost' => rand(50, 300) * 1_000_000,
                    'created_by'     => $owner->id,
                ]);

                // Assign 1–4 pekerja random
                $assignedWorkers = $workers->random(rand(1, min(4, $workers->count())));

                foreach ($assignedWorkers as $worker) {
                    ProjectAssignment::create([
                        'project_id'    => $project->id,
                        'user_id'       => $worker->id,
                        'assigned_date' => Carbon::now()->subDays(rand(1, 10)),
                    ]);
                }
            }
        });

        $this->command->info('Seeder proyek berhasil dijalankan.');
    }
}
