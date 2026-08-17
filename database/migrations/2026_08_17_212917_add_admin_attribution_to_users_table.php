<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tracks which admin account performed the "mark reviewed" action and
     * which admin last updated the private rating/notes for a candidate,
     * so multiple admins (e.g. Ebraam, Caroline, Dalia) can see who did what.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('reviewed_by')->nullable()->after('application_status')->constrained('users')->nullOnDelete();
            $table->foreignId('notes_updated_by')->nullable()->after('admin_notes')->constrained('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('reviewed_by');
            $table->dropConstrainedForeignId('notes_updated_by');
        });
    }
};
