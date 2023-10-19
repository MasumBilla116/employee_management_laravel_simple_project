<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('designation_id')->unsigned()->nullable();
            $table->bigInteger('emp_type_id')->unsigned()->nullable();
            $table->date('joining_date');
            $table->date('DoB');
            $table->string('gender');
            $table->string('address');
            $table->integer('salary');
            $table->string('religion');
            $table->string('experience');
            $table->foreign('user_id')->references('id')->on('users')->noDelete('cascade');
            $table->foreign('designation_id')->references('designation_id')->on('designations')->noDelete('cascade');
            $table->foreign('emp_type_id')->references('emp_type_id')->on('employee_types')->noDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
