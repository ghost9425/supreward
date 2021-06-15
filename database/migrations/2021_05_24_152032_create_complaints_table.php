<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            // $table->string('prefix');
            $table->string('detail');
            $table->string('image', 255);
            // $table->binary('image')->nullable();
            $table->unsignedBigInteger('prefix_id');
            $table->timestamps();
            $table->foreign('prefix_id')->references('id')->on('prefix');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('complaints');
    }
}
