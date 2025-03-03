<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'Dashboard View',
            'Attendance View',
            'Attendance Create',
            'Attendance Edit',
            'Attendance Delete',
            'Department View',
            'Department Create',
            'Department Edit',
            'Department Delete',
            'Employee View',
            'Employee Create',
            'Employee Show',
            'Employee Edit',
            'Employee Delete',
            'Schedule View',
            'Schedule Create',
            'Schedule Edit',
            'Schedule Delete',
            'Device View',
            'Device Create',
            'Device Edit',
            'Device Delete',
            'Reports View',
            'Settings View',
            'User View',
            'User Create',
            'User Edit',
            'User Delete',
        ];

        foreach ($permissions as $permissionName) {
            Permission::updateOrCreate(['name' => $permissionName], [
                'guard_name' => 'web',
                "created_at" => now(),
                'updated_at' => now()
            ]);
        }
    }
}
