<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Banner;
class BannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bannerRecords = [
            ['id'=>1,
            'type'=>'slider',
            'image'=>'slide-1.jpg',
            'link'=>'slide-1.jpg',
            'title'=>'gedung serba guna makassar',
            'alt'=>'gedung makassar',
            'sort'=>1,
            'status'=>1]
        ];

        Banner::insert($bannerRecords);
    }
}
