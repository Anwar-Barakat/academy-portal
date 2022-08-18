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
        Schema::create('student_promotions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->cascadeOnUpdate();

            $table->foreignId('from_grade')->constrained('grades')->cascadeOnUpdate();
            $table->foreignId('from_classroom')->constrained('classrooms')->cascadeOnUpdate();
            $table->foreignId('from_section')->constrained('sections')->cascadeOnUpdate();
            $table->string('academic_year');

            $table->foreignId('to_grade')->constrained('grades')->cascadeOnUpdate();
            $table->foreignId('to_classroom')->constrained('classrooms')->cascadeOnUpdate();
            $table->foreignId('to_section')->constrained('sections')->cascadeOnUpdate();
            $table->string('new_academic_year');

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
        Schema::dropIfExists('student_promotions');
    }
};