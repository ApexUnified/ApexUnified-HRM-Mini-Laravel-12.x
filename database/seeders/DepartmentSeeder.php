<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Department::doesntExist()) {
            Department::create([
                'department_name' => "Default Department",
                'branch_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
