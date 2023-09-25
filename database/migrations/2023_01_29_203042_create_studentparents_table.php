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
        Schema::create('studentparents', function (Blueprint $table) {
            $table->id();
            $table->string("email")->unique()->nullable();
            $table->string("password")->nullable();;

            $table->string("name_father")->nullable();;
            $table->string("phone_father")->nullable();;
            $table->string("job_father")->nullable();

            $table->string("father_id_number")->nullable()->unique();

            $table->unsignedBigInteger("area_father_id")->nullable();
            $table->foreign("area_father_id")->references("id")->on("areas")->onDelete('cascade');
/*mother**/
            $table->string("name_mother")->nullable();;
            $table->string("phone_mother")->nullable();
            $table->string("mother_id_number")->nullable()->unique();

            $table->string("job_mother")->nullable();;
            $table->unsignedBigInteger("area_mother_id")->nullable();
            $table->foreign("area_mother_id")->references("id")->on("areas")->onDelete('cascade');
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
        Schema::dropIfExists('studentparents');
    }
};
