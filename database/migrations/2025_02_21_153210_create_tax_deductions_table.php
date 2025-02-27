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
        Schema::create('tax_deductions', function (Blueprint $table) {
            $table->id();
            $table->string("tax_type");
            $table->decimal("tax_percentage", 20, 2);
            $table->decimal("tax_amount");
            $table->longText("description")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tax_deductions');
    }
};
