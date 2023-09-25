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
        Schema::create('marks', function (Blueprint $table) {
            $table->id();
            $table->string("mark");
            $table->dateTime("time")->nullable();
            $table->string("active")->nullable();
            $table->unsignedBigInteger("sub_material_id")->nullable();
            $table->foreign("sub_material_id")->references("id")->on("sub_material")->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger("exam_id")->nullable();
            $table->foreign("exam_id")->references("id")->on("exams");
            $table->unsignedBigInteger("student_id");
            $table->foreign("student_id")->references("id")->on("students");
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
        Schema::dropIfExists('marks');
    }
};
