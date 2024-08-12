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
            $table->tinyInteger('member_id')->nullable();
            $table->string('family_member_name')->nullable();
            $table->string('family_member_occupation')->nullable();
            $table->string('family_member_age')->nullable();
            $table->string('family_member_relation')->nullable();
            $table->string('family_member_image')->nullable();
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
