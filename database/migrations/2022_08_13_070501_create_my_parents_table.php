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
        Schema::create('my_parents', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('password');

            //! Father Information :
            $table->string('father_name');
            $table->string('father_identification');
            $table->string('father_passport');
            $table->string('father_phone');
            $table->string('father_job');
            $table->foreignId('father_nationality_id')->constrained('nationalities')->cascadeOnUpdate();
            $table->foreignId('father_blood_id')->constrained('bloods')->cascadeOnUpdate();
            $table->foreignId('father_religion_id')->constrained('religions')->cascadeOnUpdate();
            $table->string('father_address');

            //! Mother Information :
            $table->string('mother_name');
            $table->string('mother_identification');
            $table->string('mother_passport');
            $table->string('mother_phone');
            $table->string('mother_job');
            $table->foreignId('mother_nationality_id')->constrained('nationalities')->cascadeOnUpdate();
            $table->foreignId('mother_blood_id')->constrained('bloods')->cascadeOnUpdate();
            $table->foreignId('mother_religion_id')->constrained('religions')->cascadeOnUpdate();
            $table->string('mother_address');
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
        Schema::dropIfExists('my_parents');
    }
};
