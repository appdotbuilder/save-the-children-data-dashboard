<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Super Administrator',
                'name_nepali' => 'सुपर प्रशासक',
                'description' => 'Full system access with all permissions',
                'permissions' => ['all'],
                'status' => 'active',
            ],
            [
                'name' => 'Administrator',
                'name_nepali' => 'प्रशासक',
                'description' => 'Administrative access for managing tags, sectors, and categories',
                'permissions' => ['manage_tags', 'manage_sectors', 'manage_categories', 'view_reports'],
                'status' => 'active',
            ],
            [
                'name' => 'Palika Data Entry User',
                'name_nepali' => 'पालिका डेटा प्रविष्टि प्रयोगकर्ता',
                'description' => 'Can enter and edit data for their assigned municipality',
                'permissions' => ['create_data_entry', 'edit_own_data', 'view_municipality_data'],
                'status' => 'active',
            ],
            [
                'name' => 'Viewer',
                'name_nepali' => 'दर्शक',
                'description' => 'Read-only access to view dashboards and reports',
                'permissions' => ['view_dashboards', 'view_reports'],
                'status' => 'active',
            ],
        ];

        foreach ($roles as $roleData) {
            Role::create($roleData);
        }
    }
}