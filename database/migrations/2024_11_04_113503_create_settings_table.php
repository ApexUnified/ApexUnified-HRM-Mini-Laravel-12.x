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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string("system_title")->nullable();
            $table->string("system_logo")->nullable();
            $table->string("favicon")->nullable();
            $table->string("auth_logo")->nullable();
            $table->string("company_name")->nullable();
            $table->string("time_zone")->nullable();
            $table->string("currency")->nullable();
            $table->string("developed_by")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
