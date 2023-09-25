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
        Schema::create('presence_absence', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->unsignedBigInteger("section_id")->nullable();
            $table->foreign("section_id")->references("id")->on("sections")->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('presence_absence');
    }
};
