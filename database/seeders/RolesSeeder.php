<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                $roles =[
                    ['name' => 'admin' , 'guard_name' => 'web'],
                    ['name' => 'staff' , 'guard_name' => 'web'],
                    ['name' => 'client' , 'guard_name' => 'client'],
                ];
    

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
            $this->command->info("Role created: {$role['name']} ({$role['guard_name']})");
                     

        }
    }
}
