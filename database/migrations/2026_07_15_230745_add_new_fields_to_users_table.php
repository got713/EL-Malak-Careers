<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('confession_father')->nullable();
            $table->string('applicant_church')->nullable();
            $table->string('current_company')->nullable();
            $table->string('employment_status')->nullable(); // 'employed', 'unemployed', 'other'
            $table->date('application_date')->nullable();
            $table->json('languages')->nullable();
            $table->integer('microsoft_office_skills')->nullable(); // rating 1 to 5
            $table->text('experience_details')->nullable();
            $table->string('last_salary')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'confession_father',
                'applicant_church',
                'current_company',
                'employment_status',
                'application_date',
                'languages',
                'microsoft_office_skills',
                'experience_details',
                'last_salary',
            ]);
        });
    }
};
