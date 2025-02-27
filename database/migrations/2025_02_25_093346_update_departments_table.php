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
        Schema::table("departments", function (Blueprint $table) {
            $table->foreignId("branch_id")->after("department_name")->constrained("branches")->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("departments", function (Blueprint $table) {
            $table->dropForeign("departments_branch_id_foreign");
        });
    }
};
