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
            $table->timestamps();
            $table->string('image_url');
            $table->boolean('was_liked');
            $table->string('title');
            $table->text('description');
            $table->unsignedBigInteger('agency_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('pub_request_id');
            $table->foreign('agency_id')->references('id')->on('agencies');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('pub_request_id')->references('id')->on('pub_requests');
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
