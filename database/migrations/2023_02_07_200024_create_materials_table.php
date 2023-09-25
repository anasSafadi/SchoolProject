<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string("name");

//            $table->unsignedBigInteger("grade_id");
//            $table->foreign("grade_id")->references("id")->on("grades");
//
//
//            $table->unsignedBigInteger("class_room_id");
//            $table->foreign("class_room_id")->references("id")->on("classrooms");

//            $table->unsignedBigInteger("classroom_id");
//            $table->foreign("classroom_id")->references("id")->on("classrooms");
//
//            $table->unsignedBigInteger("teacher_id")->nullable();
//            $table->foreign("teacher_id")->references("id")->on("teachers");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materials');
    }
};
