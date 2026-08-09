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
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'outlook_id')) {
                $table->dropColumn('outlook_id');
            }
            if (Schema::hasColumn('users', 'outlook_token')) {
                $table->dropColumn('outlook_token');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('outlook_id')->nullable();
            $table->text('outlook_token')->nullable();
        });
    }
};
