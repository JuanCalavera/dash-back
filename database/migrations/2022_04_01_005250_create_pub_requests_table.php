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
        Schema::create('pub_requests', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('agency_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('theme_id');
            $table->unsignedBigInteger('draw_type_id');
            $table->foreign('agency_id')->references('id')->on('agencies')->cascadeOnDelete();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('theme_id')->references('id')->on('themes');
            $table->foreign('draw_type_id')->references('id')->on('draw_types');
            $table->date('deliver_date');
            $table->string('size');
            $table->text('description')->default('');
            $table->text('exhibition_description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pub_requests');
    }
};
