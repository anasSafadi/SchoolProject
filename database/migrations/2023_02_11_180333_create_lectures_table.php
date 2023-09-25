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
        Schema::create('lectures', function (Blueprint $table) {
            $table->id();
            $table->string("title")->nullable();
            $table->string("description")->nullable();
            $table->unsignedBigInteger("teacher_id")->nullable();
            $table->foreign("teacher_id")->references("id")->on("teachers")->onUpdate('cascade');
            $table->unsignedBigInteger("sub_material_id")->nullable();
            $table->foreign("sub_material_id")->references("id")->on("sub_material")->onUpdate('cascade');
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
        Schema::dropIfExists('lectures');
    }
};
