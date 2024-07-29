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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('appartment_id')->nullable();
            $table->tinyInteger('building_id')->nullable();
            $table->string('member_name')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('nationality')->nullable();
            $table->string('religion')->nullable();
            $table->string('intercome_no')->nullable();
            $table->string('land_phone')->nullable();
            $table->string('mobile_phone')->nullable();
            $table->string('email')->nullable();
            $table->string('car_no')->nullable();
            $table->string('nid_no')->nullable();
            $table->string('nid')->nullable();
            $table->string('image')->nullable();
            $table->string('flat_reg_document')->nullable();
            $table->string('garage_no')->nullable();
            $table->string('occupation')->nullable();
            $table->string('institute_name')->nullable();
            $table->string('institute_addres')->nullable();
            $table->string('location')->nullable();
            $table->enum('status',[1, 0])->default(1);
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
        Schema::dropIfExists('members');
    }
};
