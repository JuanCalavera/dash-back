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
            $table->unsignedBigInteger('pub_type_id');
            $table->unsignedBigInteger('pub_sub_type_id');
            $table->foreign('agency_id')->references('id')->on('agencies')->cascadeOnDelete();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('pub_type_id')->references('id')->on('pub_types');
            $table->foreign('pub_sub_type_id')->references('id')->on('pub_sub_types');
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
