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
        Schema::create('home_work', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("descriptions");
            $table->date("end_date");
            $table->unsignedBigInteger("sub_material_id")->nullable();
            $table->foreign("sub_material_id")->references("id")->on("sub_material")->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('home_work');
    }
};
