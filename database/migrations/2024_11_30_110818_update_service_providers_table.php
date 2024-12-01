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
            $table->enum('gender', ['Male', 'Female'])->nullable();
            $table->date('date_of_birth')->nullable();
            $table->integer('years_of_experience')->nullable();
            $table->string('education')->nullable();
            $table->json('skills')->nullable();
            $table->json('languages_spoken')->nullable();
            $table->json('availability')->nullable();
            $table->decimal('hourly_rate', 8, 2)->nullable();
            $table->json('work_shifts')->nullable(); // Replacing max_work_hours
            $table->json('work_locations')->nullable();
            $table->boolean('background_checked')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_providers', function (Blueprint $table) {
            $table->dropColumn([
                'gender',
                'date_of_birth',
                'years_of_experience',
                'education',
                'skills',
                'languages_spoken',
                'availability',
                'hourly_rate',
                'work_shifts',
                'work_locations',
                'background_checked',
            ]);
        });
    }
};
