<?php

namespace Database\Seeders;

use App\Models\Teacher\Area;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $areas=[
            ["en"=>"Bureij","ar"=>"البريج"],
            ["en"=>"Nuseirat","ar"=>"النصيرات"],
            ["en"=>"Maghazi","ar"=>"المغازي"],

        ];
        DB::table('areas')->delete();
        foreach ($areas as $area) {
            $class=new Area();
            $class->name_area=$area;
            $class->save();
        }

    }
}
