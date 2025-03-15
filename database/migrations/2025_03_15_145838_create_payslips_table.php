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
        Schema::create('payslips', function (Blueprint $table) {
            $table->id();
            $table->foreignId("employee_id")->constrained("employees")->cascadeOnDelete()->cascadeOnUpdate();
            $table->decimal("base_salary", 20, 2);
            $table->decimal("overtime", 20, 2)->nullable();
            $table->decimal("allowance", 20, 2)->nullable();
            $table->decimal("bonus", 20, 2)->nullable();
            $table->decimal("deduction", 20, 2)->nullable();
            $table->decimal("tax_deduction", 20, 2)->nullable();
            $table->decimal("loan_deduction", 20, 2)->nullable();
            $table->decimal("attendance_deduction", 20, 2)->nullable();
            $table->decimal("net_salary", 20, 2);
            $table->enum("status", ["Pending", "Approved", "Paid"])->default("Pending");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payslips');
    }
};
