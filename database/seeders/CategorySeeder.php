<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Bút bi'],
            ['name' => 'Bút chì'],
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}
