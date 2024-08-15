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
        Schema::create('appartments', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('building_id')->nullable();
            $table->tinyInteger('floor_id')->nullable();
            $table->string('appartment_name');
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('booking_status')->default(0);
            $table->string('created_date');
            $table->string('created_by');
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
        Schema::dropIfExists('appartments');
    }
};
