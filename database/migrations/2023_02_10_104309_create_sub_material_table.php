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
        Schema::create('sub_material', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("material_id")->nullable();
            $table->foreign("material_id")->references("id")->on("materials")->onUpdate('cascade');


            $table->unsignedBigInteger("grade_id")->nullable();
            $table->foreign("grade_id")->references("id")->on("grades")->onUpdate('cascade');

            $table->unsignedBigInteger("classroom_id")->nullable();
            $table->foreign("classroom_id")->references("id")->on("classrooms")->onUpdate('cascade');

            $table->unsignedBigInteger("teacher_id")->nullable();
            $table->foreign("teacher_id")->references("id")->on("teachers")->onUpdate('cascade');
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
        Schema::dropIfExists('sub_material');
    }
};
