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
        Schema::create('loan_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId("employee_id")->constrained("employees")->cascadeOnDelete()->cascadeOnUpdate();
            $table->string("loan_type");
            $table->decimal("loan_amount", 20, 2);
            $table->decimal("loan_deduction_amount", 20, 2);
            $table->decimal("remeaning_loan", 20, 2)->nullable();
            $table->enum("status", ["Active", "Completed"])->default("Active");
            $table->longText("description")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_payments');
    }
};
