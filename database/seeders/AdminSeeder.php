<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Admin::factory()->count(5)->create();

        //\App\Models\Admin::factory(2)->create();

        \App\Models\Admin::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
        ]);
    }
}
