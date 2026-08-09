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
        Schema::table('companies', function (Blueprint $table) {
            $table->string('linkedin')->nullable();
        });

        Schema::table('job_postings', function (Blueprint $table) {
            $table->integer('vacancies')->default(1);
            $table->string('experience_years')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('linkedin');
        });

        Schema::table('job_postings', function (Blueprint $table) {
            $table->dropColumn(['vacancies', 'experience_years']);
        });
    }
};
