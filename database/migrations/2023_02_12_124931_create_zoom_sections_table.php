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
        Schema::create('zoom_sections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("online_id")->nullable();
            $table->foreign("online_id")->references("id")->on("online_lectures")->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger("section_id")->nullable();
            $table->foreign("section_id")->references("id")->on("sections")->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('zoom_sections');
    }
};
