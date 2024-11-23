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
        Schema::table('service_providers', function (Blueprint $table) {
            $table->string('specialty')->nullable()->after('user_id'); // Area of expertise
            $table->decimal('hourly_rate', 10, 2)->nullable()->after('certifications'); // Hourly rate
            $table->string('availability')->nullable()->after('hourly_rate'); // Availability
            $table->string('phone', 15)->nullable()->after('availability'); // Contact number
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active')->after('phone'); // Provider status
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_providers', function (Blueprint $table) {
            $table->dropColumn(['specialty', 'hourly_rate', 'availability', 'phone', 'status']);
        });
    }
};
