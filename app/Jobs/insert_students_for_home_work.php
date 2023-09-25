<?php

namespace App\Jobs;

use App\Models\assignment_delivery;
use App\Models\Teacher\Section;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use function Symfony\Component\Console\Style\section;

class insert_students_for_home_work implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $ids_of_sections,$id_of_home_work;
    public function __construct($ids_sections,$id_home_work)
    {
        $this->ids_of_sections=$ids_sections;
        $this->id_of_home_work=$id_home_work;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //return $ids_of_students=Section::find($request->all_sections_ids)[0]->students[0]->id;
        $sections=Section::find($this->ids_of_sections);



        foreach ($sections as $section){


            foreach ($section->students as $student){

                $a=new assignment_delivery;
                $a->active="0";
                $a->home_work_id=$this->id_of_home_work;
                $a->student_id=$student->id;
                $a->save();

            }



        }







    }





}
