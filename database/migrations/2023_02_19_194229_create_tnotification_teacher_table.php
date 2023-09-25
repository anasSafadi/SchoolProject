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
        Schema::create('tnotification_teacher', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("teacher_notification_id");
            $table->foreign("teacher_notification_id")->references("id")->on("teacher_notification")->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger("teacher_id");
            $table->foreign("teacher_id")->references("id")->on("teachers")->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('tnotification_teacher');
    }
};
