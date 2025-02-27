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
            $table->bigInteger("employee_id");
            $table->string("employee_name");
            $table->string("father_name");
            $table->string("employee_dob");
            $table->string("date_of_hiring");
            $table->foreignId("department_id")->constrained("departments")->cascadeOnDelete()->cascadeOnUpdate();
            $table->string("employee_schedule");
            $table->string("designation");
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
