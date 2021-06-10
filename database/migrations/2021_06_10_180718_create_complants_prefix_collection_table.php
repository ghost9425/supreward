<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplantsPrefixCollectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complants_prefix_collection', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('complants_id');
            $table->unsignedBigInteger('prefix_id');
            $table->unsignedTinyInteger('complaints_success');
            $table->timestamps();
            $table->foreign('id')->references('id')->on('complaints');
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
        Schema::dropIfExists('complants_prefix_collection');
    }
}
