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
        Schema::create('assignment_delivery', function (Blueprint $table) {
            $table->id();
            $table->string("active")->default("0");
            $table->unsignedBigInteger("sub_material_id")->nullable();
            $table->foreign("sub_material_id")->references("id")->on("sub_material")->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger("home_work_id");
            $table->foreign("home_work_id")->references("id")->on("home_work")->onDelete("cascade")->onUpdate("cascade");

            $table->unsignedBigInteger("student_id")->nullable();
            $table->foreign("student_id")->references("id")->on("students")->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('assignment_delivery');
    }
};
