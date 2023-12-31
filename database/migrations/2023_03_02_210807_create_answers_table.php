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
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->string("answer");
            $table->unsignedBigInteger("question_id")->nullable();
            $table->foreign("question_id")->references("id")->on("questions");
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
        Schema::dropIfExists('answers');
    }
};
