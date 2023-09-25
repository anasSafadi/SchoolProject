<?php

namespace Database\Seeders;

use App\Models\Specialty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class specialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specialty=[
            ["en"=>"computer science","ar"=>"شبكات حاسوب"],
            ["en"=>"Networks","ar"=>"علوم حاسوب"],
            ["en"=>"Mathematics","ar"=>"رياضيات"],

        ];
        DB::table('specialtys')->delete();
        foreach ($specialty as $item) {
            $s=new Specialty();
            $s->title=$item;
            $s->save();
        }
    }
}
