<?php

use App\Models\Position;
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
        Schema::table('employees', function (Blueprint $table) {
            $table->enum("gender", ["Male", "Female", "Other"])->nullable();
            $table->foreignId("position_id")->nullable()->constrained("positions")->nullOnDelete()->cascadeOnUpdate();
            $table->date("joining_date")->nullable();
            $table->string("religion")->nullable();

            $table
                ->enum(
                    "marital_status",
                    [
                        'Single',
                        'Married',
                        'Divorced',
                        'Widowed',
                        'Separated'
                    ]
                )
                ->nullable();

            $table->longText("home_address")->nullable();
            $table->string("contact_number")->nullable();
            $table->string("email")->unique()->nullable();
            $table->string("cnic_number")->nullable();
            $table->string("eobi_number")->nullable();
            $table->string("sessi_number")->nullable();

            $table
                ->enum(
                    "blood_group",
                    [
                        'A+',
                        'A-',
                        'B+',
                        'B-',
                        'O+',
                        'O-',
                        'AB+',
                        'AB-'
                    ]
                )
                ->nullable();

            $table->string("qualification")->nullable();
            $table->longText("emergency_contact_details")->nullable();
            $table->string("emergency_contact_number")->nullable();
            $table->json("family_member_details")->nullable();
            $table->string("remarks")->nullable();
            $table->json("documents")->nullable();
            $table->string("profile")->nullable();
            $table->string("created_by")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {

            $table
                ->dropForeign(['position_id']);;

            $table
                ->dropColumn(
                    [
                        "gender",
                        "joining_date",
                        "religion",
                        "position_id",
                        "marital_status",
                        "home_address",
                        "contact_number",
                        "email",
                        "cnic_number",
                        "eobi_number",
                        "sessi_number",
                        "blood_group",
                        "qualification",
                        "emergency_contact_details",
                        "emergency_contact_number",
                        "family_member_details",
                        "remarks",
                        "documents",
                        "profile",
                        "created_by"
                    ]
                );
        });
    }
};
