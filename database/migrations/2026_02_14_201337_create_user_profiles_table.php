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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            // Relationship to the users table
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Personal Details
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->char('middle_initial', 2)->nullable();
            $table->string('other_last_names')->nullable();
            // Contact & Address
            $table->string('street_address')->nullable();
            $table->string('apt')->nullable();
            $table->string('city')->nullable();
            $table->string('state', 2)->nullable();
            $table->string('zip', 10)->nullable();
            // Contact & Address
            $table->date('date_of_birth')->nullable();
            $table->string('ssn', 11)->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->enum('status',['U.S. Citizen','Noncitizen National','Lawful Permanent Resident','Alien Authorized to Work'])->nullable();
            // Legal & Sensitive Info
            $table->string('uscis_a_number')->nullable();
            $table->string('i94_admission_number')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('passport_country')->nullable();
            $table->date('work_authorization_expiration')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
