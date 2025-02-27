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
        Schema::create('allowances', function (Blueprint $table) {
            $table->id();
            $table->string("allowance_type");
            $table->enum("frequency", ["Daily", "Monthly", "Quarterly", "Annually"])->default("Monthly");
            $table->json("eligibility")->nullable();
            $table->longText("description")->nullable();
            $table->decimal("allowance_amount", 20, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allowances');
    }
};
