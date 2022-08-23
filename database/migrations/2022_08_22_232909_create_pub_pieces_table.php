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
        Schema::create('pub_pieces', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->string('title');
            $table->text('description');
            $table->string('deliver_date');
            $table->string('size');
            $table->string('files_path');
            $table->bigInteger('user_id');
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
        Schema::dropIfExists('pub_pieces');
    }
};
