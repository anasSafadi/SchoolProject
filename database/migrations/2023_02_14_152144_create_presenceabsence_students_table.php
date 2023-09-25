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
        Schema::create('presenceabsence_students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("presence_absence_id");
            $table->foreign("presence_absence_id")->references("id")->on("presence_absence")->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger("student_id");
            $table->foreign("student_id")->references("id")->on("students")->onDelete('cascade')->onUpdate('cascade');
            $table->string("active");
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
        Schema::dropIfExists('presenceabsence_students');
    }
};
