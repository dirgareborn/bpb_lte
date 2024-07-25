<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoriesRecords = [
            [   
                'id' => 1,
                'parent_id'=>0,
                'category_name' => 'Gedung Serba Guna',
                'category_image' => '',
                'category_discount' => 0,
                'description' => 'Gedung serba Guna Makassar',
                'url' => 'gedung-serba-guna',
                'meta_title' => 'Gedung serba Guna Makassar',
                'meta_description' => 'Gedung serba Guna Makassar',
                'meta_keywords' => 'Gedung serba Guna Makassar',
                'status' => 1,
            ],
            [   
                'id' => 2,
                'parent_id'=>0,
                'category_name' => 'Lapangan Olah Raga',
                'category_image' => '',
                'category_discount' => 0,
                'description' => 'sewa lapangan murah Makassar',
                'url' => 'lapangan-olahraga',
                'meta_title' => 'sewa lapangan murah Makassar',
                'meta_description' => 'sewa lapangan murah Makassar',
                'meta_keywords' => 'sewa lapangan murah Makassar',
                'status' => 1,
            ],
            [   
                'id' => 3,
                'parent_id'=>1,
                'category_name' => 'Hall Convention',
                'category_image' => '',
                'category_discount' => 0,
                'description' => 'Hall Convention Murah Makassar',
                'url' => 'hall-convention',
                'meta_title' => 'Rental Hall Convention Murah  Makassar',
                'meta_description' => 'Rental Hall Convention Murah Makassar',
                'meta_keywords' => 'Rental Hall Convention Murah Makassar',
                'status' => 1,
            ],
        ];
    
        Category::insert($categoriesRecords);
        }
}
