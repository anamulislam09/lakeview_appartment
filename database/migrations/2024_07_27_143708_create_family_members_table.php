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
        Schema::create('family_members', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('building_id')->nullable();
            $table->tinyInteger('member_id')->nullable();
            $table->string('name');
            $table->string('occupation')->nullable();
            $table->string('age')->nullable();
            $table->string('relation')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('family_members');
    }
};
