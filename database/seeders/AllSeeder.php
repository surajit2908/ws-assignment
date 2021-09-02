<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Permission;

class AllSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'id' => '1',
            'name' => 'Admin',
            'phone' => '7894561230',
            'email' => 'info@webassgn.com',
            'password' => bcrypt('password')
        ]);

        Permission::create([
            'module_name' => 'create-gallery',
        ]);

        Permission::create([
            'module_name' => 'edit-gallery',
        ]);

        Permission::create([
            'module_name' => 'delete-gallery',
        ]);

        Permission::create([
            'module_name' => 'list-gallery',
        ]);
    }
}
