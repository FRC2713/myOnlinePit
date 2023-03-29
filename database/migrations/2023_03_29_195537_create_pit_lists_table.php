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
        Schema::create('pit_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('signed', 1000);
            $table->json('list');
            $table->string('match_num', 10);
            $table->string('event');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pit_lists');
    }
};
