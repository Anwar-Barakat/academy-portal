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
        Schema::create('fund_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('studentReceipt_id')->nullable()->constrained('student_receipts')->cascadeOnDelete()->cascadeOnDelete();
            $table->foreignId('studentPayment_id')->nullable()->constrained('student_payments')->cascadeOnDelete()->cascadeOnDelete();
            $table->decimal('debit', 8, 2);
            $table->decimal('credit', 8, 2);
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
        Schema::dropIfExists('fund_accounts');
    }
};