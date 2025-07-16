<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class AutoGeneratePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          $routes = Route::getRoutes();

        foreach ($routes as $route) {
            $name = $route->getName();

            // نتأكد إن الراوت له اسم ونتجاهل راوتات لاراڤيل الافتراضية
            if ($name && !Permission::where('name', $name)->exists()) {
                Permission::create(['name' => $name]);
                $this->command->info("Permission created: {$name}");
            }
        }
    }
}
