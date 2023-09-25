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
        Schema::create('send_admin_to_teacher', function (Blueprint $table) {
            $table->id();
            $table->string("title_msg");
            $table->text("content_msg");
            $table->string("total_count_receivers")->nullable();
            $table->string("web_count_receivers")->nullable()->default("-1");
            $table->string("gmail_count_receivers")->nullable()->default("-1");;
            $table->string("sms_count_receivers")->nullable()->default("-1");
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
        Schema::dropIfExists('send_admin_to_teacher');
    }
};
