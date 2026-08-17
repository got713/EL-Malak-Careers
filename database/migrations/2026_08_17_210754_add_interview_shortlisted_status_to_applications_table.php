<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * The company review flow now needs an "interview" and a "shortlisted"
     * step in between "pending" and "accepted"/"rejected", so the status
     * enum needs to grow to match what the UI already offers.
     */
    public function up(): void
    {
        $driver = Schema::getConnection()->getDriverName();

        if ($driver === 'mysql' || $driver === 'mariadb') {
            DB::statement("ALTER TABLE applications MODIFY status ENUM('pending', 'reviewed', 'interview', 'shortlisted', 'accepted', 'rejected') NOT NULL DEFAULT 'pending'");
        } elseif ($driver === 'sqlite') {
            // SQLite has no native ENUM (it's just a CHECK constraint added by Laravel),
            // and column redefinition needs a table rebuild which Schema::table()->enum()
            // can't do without doctrine/dbal. Since values are stored as plain strings,
            // no structural change is required for SQLite - it already accepts any string.
        } else {
            // Fallback for other drivers (e.g. pgsql) if ever used.
            Schema::table('applications', function ($table) {
                $table->string('status')->default('pending')->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $driver = Schema::getConnection()->getDriverName();

        if ($driver === 'mysql' || $driver === 'mariadb') {
            // Move any rows using the new statuses back to 'pending' before shrinking the enum.
            DB::table('applications')->whereIn('status', ['interview', 'shortlisted'])->update(['status' => 'pending']);
            DB::statement("ALTER TABLE applications MODIFY status ENUM('pending', 'reviewed', 'accepted', 'rejected') NOT NULL DEFAULT 'pending'");
        }
    }
};
