<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // $this->call(AdminTableSeeder::class);
        // $this->call(CmsPageTableSeeder::class);
        // $this->call(CategoryTableSeeder::class);
        // $this->call(LocationTableSeeder::class);
        // $this->call(ProductTableSeeder::class);
        // $this->call(ProductsImagesTableSeeder::class);
        $this->call(BannersTableSeeder::class);
    }
}
