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
        Schema::create('budget_types_on', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('pub_request_id');
            $table->unsignedBigInteger('budget_type_id');
            $table->foreign('pub_request_id')->references('id')->on('pub_requests')->cascadeOnDelete();
            $table->foreign('budget_type_id')->references('id')->on('budget_types')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('budget_types_on');
    }
};
