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
        Schema::create('puhsup', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('from_grade_id');
            $table->foreign('from_grade_id')->references('id')->on('grades')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('from_classroom_id');
            $table->foreign('from_classroom_id')->references('id')->on('classrooms')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('from_section_id')->unsigned();
            $table->foreign('from_section_id')->references('id')->on('sections')->onDelete('cascade');

            /**------------------------------------to -------------------**/

            $table->unsignedBigInteger('to_grade_id');
            $table->foreign('to_grade_id')->references('id')->on('grades')->onDelete('cascade');

            $table->unsignedBigInteger('to_classroom_id');
            $table->foreign('to_classroom_id')->references('id')->on('classrooms')->onDelete('cascade');

            $table->unsignedBigInteger('to_section_id')->unsigned();
            $table->foreign('to_section_id')->references('id')->on('sections')->onDelete('cascade');
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
        Schema::dropIfExists('puhsup');
    }
};
