<?php

namespace Database\Seeders;

use App\Models\Municipality;
use App\Models\Role;
use App\Models\Sector;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create municipalities
        $municipalities = [
            [
                'name' => 'Kathmandu Metropolitan City',
                'name_nepali' => 'काठमाडौं महानगरपालिका',
                'type' => 'urban',
                'district' => 'Kathmandu',
                'district_nepali' => 'काठमाडौं जिल्ला',
                'status' => 'active',
            ],
            [
                'name' => 'Pokhara Metropolitan City',
                'name_nepali' => 'पोखरा महानगरपालिका',
                'type' => 'urban',
                'district' => 'Kaski',
                'district_nepali' => 'कास्की जिल्ला',
                'status' => 'active',
            ],
            [
                'name' => 'Changunarayan Municipality',
                'name_nepali' => 'चाँगुनारायण नगरपालिका',
                'type' => 'rural',
                'district' => 'Bhaktapur',
                'district_nepali' => 'भक्तपुर जिल्ला',
                'status' => 'active',
            ],
        ];

        foreach ($municipalities as $municipalityData) {
            Municipality::create($municipalityData);
        }

        // Create sample sectors
        $sectors = [
            [
                'title' => 'Education',
                'title_nepali' => 'शिक्षा',
                'status' => 'active',
            ],
            [
                'title' => 'Health',
                'title_nepali' => 'स्वास्थ्य',
                'status' => 'active',
            ],
            [
                'title' => 'Infrastructure',
                'title_nepali' => 'पूर्वाधार',
                'status' => 'active',
            ],
            [
                'title' => 'Social Welfare',
                'title_nepali' => 'सामाजिक कल्याण',
                'status' => 'active',
            ],
            [
                'title' => 'Environment',
                'title_nepali' => 'वातावरण',
                'status' => 'active',
            ],
        ];

        foreach ($sectors as $sectorData) {
            Sector::create($sectorData);
        }

        // Create sample tags
        $tags = [
            [
                'budget_heading_english' => 'Child Education Program',
                'budget_heading_nepali' => 'बाल शिक्षा कार्यक्रम',
                'status' => 'active',
            ],
            [
                'budget_heading_english' => 'Health Care Services',
                'budget_heading_nepali' => 'स्वास्थ्य सेवा',
                'status' => 'active',
            ],
            [
                'budget_heading_english' => 'Road Construction',
                'budget_heading_nepali' => 'सडक निर्माण',
                'status' => 'active',
            ],
            [
                'budget_heading_english' => 'Water Supply',
                'budget_heading_nepali' => 'खानेपानी आपूर्ति',
                'status' => 'active',
            ],
            [
                'budget_heading_english' => 'Child Protection',
                'budget_heading_nepali' => 'बाल संरक्षण',
                'status' => 'active',
            ],
        ];

        foreach ($tags as $tagData) {
            Tag::create($tagData);
        }

        // Create admin user
        $superAdminRole = Role::where('name', 'Super Administrator')->first();
        $adminRole = Role::where('name', 'Administrator')->first();
        $palikaRole = Role::where('name', 'Palika Data Entry User')->first();
        
        $kathmandu = Municipality::where('name', 'like', '%Kathmandu%')->first();
        $pokhara = Municipality::where('name', 'like', '%Pokhara%')->first();

        User::create([
            'name' => 'System Admin',
            'email' => 'admin@savethechildren.org',
            'password' => bcrypt('password'),
            'role_id' => $superAdminRole->id,
            'user_type' => 'super_admin',
        ]);

        User::create([
            'name' => 'Tag Manager',
            'email' => 'tagmanager@savethechildren.org',
            'password' => bcrypt('password'),
            'role_id' => $adminRole->id,
            'user_type' => 'admin',
        ]);

        User::create([
            'name' => 'Kathmandu Data User',
            'email' => 'kathmandu@savethechildren.org',
            'password' => bcrypt('password'),
            'role_id' => $palikaRole->id,
            'municipality_id' => $kathmandu->id,
            'user_type' => 'palika_user',
        ]);

        User::create([
            'name' => 'Pokhara Data User',
            'email' => 'pokhara@savethechildren.org',
            'password' => bcrypt('password'),
            'role_id' => $palikaRole->id,
            'municipality_id' => $pokhara->id,
            'user_type' => 'palika_user',
        ]);
    }
}