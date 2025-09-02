<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Hero;
use App\Models\Setting;
use App\Models\SmartCurtainsPage;
use App\Models\SocialLink;
use App\Models\User;
use App\Models\SectionTitle;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        // Other seeders for your data...

        // Create Admin users
        $admin = Admin::firstOrCreate([
            'email' => 'admin@gmail.com'
        ], [
            'name' => 'Super Admin',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        $sales = Admin::firstOrCreate([
            'email' => 'sales@gmail.com'
        ], [
            'name' => 'Sales Admin',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        $production = Admin::firstOrCreate([
            'email' => 'production@gmail.com'
        ], [
            'name' => 'Production Admin',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        $installation = Admin::firstOrCreate([
            'email' => 'installation@gmail.com'
        ], [
            'name' => 'Installation Admin',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        // Clean up existing roles and permissions
        foreach (Role::where('guard_name', 'admin')->get() as $role) {
            $role->delete();
        }

        foreach (Permission::where('guard_name', 'admin')->get() as $permission) {
            $permission->delete();
        }

        // Create Roles with the 'admin' guard
        $admin_role = Role::create(['name' => 'Admin', 'guard_name' => 'admin']);
        $sales_role = Role::create(['name' => 'Marketing Team', 'guard_name' => 'admin']);
        $production_role = Role::create(['name' => 'Production Team', 'guard_name' => 'admin']);
        $installation_role = Role::create(['name' => 'Installation Team', 'guard_name' => 'admin']);

        // Create Permissions with the 'admin' guard
        $permissions = [
            'Role access', 'Role edit', 'Role create', 'Role delete',
            'User access', 'User edit', 'User create', 'User delete',
            'Permission access', 'Permission edit', 'Permission create', 'Permission delete',
            'Setting access', 'Setting edit', 'Setting create', 'Setting delete',
            'Book access', 'Book create', 'Book edit', 'Book delete',
            'Contact access', 'Contact create', 'Contact edit', 'Contact delete',
            'Marketing access', 'Marketing create', 'Marketing edit', 'Marketing delete',
            'Production access', 'Production create', 'Production edit', 'Production delete',
            'Installation access', 'Installation create', 'Installation edit', 'Installation delete',
            'Product access', 'Product create', 'Product edit', 'Product delete',
            'Category access', 'Category create', 'Category edit', 'Category delete',
            'Coupon access', 'Coupon create', 'Coupon edit', 'Coupon delete',
            'Catalogue access', 'Catalogue create', 'Catalogue edit', 'Catalogue delete',
            'Salary access',
            'Stock access',
            'Website access',
            'Smart Curtains access',
            'Cache access',
            'Section Title access',
            
        ];

        foreach ($permissions as $permissionName) {
            Permission::create(['name' => $permissionName, 'guard_name' => 'admin']);
        }

        // Assign Roles to Admins
        $admin->assignRole($admin_role);
        $sales->assignRole($sales_role);
        $production->assignRole($production_role);
        $installation->assignRole($installation_role);

        // Assign Permissions to Roles
        $admin_role->givePermissionTo(Permission::where('guard_name', 'admin')->get());


       

        Setting::create([
           'header_logo' => '' 
        ]);

        Hero::create([
            'title' => 'Curtains & Blinds in Dubai & Abu Dhabi',
            'tag_line' => 'Without hassle',
            'description' => 'Elevate Your Home With Blackout Curtains, Blinds, and Sheers. Pay in 3 Installments Or Upfront. Book a free visit now!',
            'address' => 'Dubai .Abu Dhabi .Sharjah .Ajman',
        ]);

        SocialLink::create([
            'instagram' => 'https://example.com',
            'facebook' => 'https://example.com',
            'twitter' => 'https://example.com',
            'pinterest' => 'https://example.com',
            'linkedin' => 'https://example.com',
        ]);

        SmartCurtainsPage::create([
            'banner_title' => 'How to choose the best smart curtains motor?',
            'banner_description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
            'title' => 'How to choose the best smart curtains?',
            'title_description' => 'Take a look at the different steps you need to know in order to find the perfect match for your curtains.',
            'title_text' => 'Step 1: choose your curtain type depending on your preferences and needs',
            'step_one_title' => 'Step 1: choose your curtain type depending on your preferences and needs',
            'step_one_description' => 'When you start an interior design project, especially when choosing curtains, ',
            'step_one_title_one' => 'Curtains',
            'step_one_title_one_description' => 'When you start an interior design project, especially when choosing curtains, ',
            'step_one_title_two' => 'Motorized',
            'step_one_title_two_description' => 'When you start an interior design project, especially when choosing curtains, ',
            'step_two_title' => 'Step 2 : evaluate the benefits of electric curtains',
            'step_two_description' => 'There are several benefits to a smart curtain opener throughout the year',
            'step_three_title' => 'Step 3: choose a control mode that suits your lifestyle',
            'step_three_description' => 'Once you have selected your smart curtain motor, you need to choose a control mode.',
            'step_four_title' => 'Step 4: choose complementary accessories',
            'step_five_title' => 'Step 5: install your smart electric curtain',
            'step_five_description' => 'Taking measures for such an installation requires special knowledge',
            'step_six_title' => 'Go further',

        ]);
        
         SectionTitle::create([
            'home_section_title' => '"Trusted by Over 1,000 Satisfied Customers—Your Premier Choice for Blinds & Curtains."'
        ]);


    }
}
