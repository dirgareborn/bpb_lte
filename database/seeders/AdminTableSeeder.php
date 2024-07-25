<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('123456');
        $adminRecords = [
            'id' => 2, 
            'name'=>'Customer Service',
            'type'=>'cs',
            'mobile' => '085299444338',
            'email'=>'cs@mallbisnisunm.com',
            'password'=>$password,
            'image'=>'',
            'status'=>1,
        ];

        Admin::insert($adminRecords);

    }
}
