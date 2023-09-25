<?php

namespace Database\Seeders;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
       User::create([
           "name"=>"asda",
           "email"=>"admin@gmail.com",
           "password"=>Hash::make("123456"),
       ]);
//        Teacher::create([
//            "email"=>"t@t.com",
//            "password"=>Hash::make("123"),
//        ]);
    }
}
