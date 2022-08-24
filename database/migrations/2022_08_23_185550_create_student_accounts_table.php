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
        Schema::create('student_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('feeInvoice_id')->nullable()->constrained('fee_invoices')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('studentReceipt_id')->nullable()->constrained('student_receipts')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('feeProcessing_id')->nullable()->constrained('fee_processings')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('studentPayment_id')->nullable()->constrained('student_payments')->cascadeOnDelete()->cascadeOnUpdate();
            $table->decimal('debit', 8, 2)->default(0);
            $table->decimal('credit', 8, 2)->default(0);
            $table->string('description')->nullable();
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
        Schema::dropIfExists('student_accounts');
    }
};
