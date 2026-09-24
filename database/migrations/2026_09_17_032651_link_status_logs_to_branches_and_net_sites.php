<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // net_sites may or may not already have this column — add it
        // only if it's missing, so this migration is safe to run
        // regardless of your current schema.
        if (!Schema::hasColumn('net_sites', 'status_logs_id')) {
            Schema::table('net_sites', function (Blueprint $table) {
                $table->unsignedBigInteger('status_logs_id')->nullable()->after('sec_vendor_id');
            });
        }

        Schema::table('branches', function (Blueprint $table) {
            $table->foreign('status_logs_id')
                ->references('id')->on('status_logs')
                ->nullOnDelete();
        });

        Schema::table('net_sites', function (Blueprint $table) {
            $table->foreign('status_logs_id')
                ->references('id')->on('status_logs')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('branches', function (Blueprint $table) {
            $table->dropForeign(['status_logs_id']);
        });

        Schema::table('net_sites', function (Blueprint $table) {
            $table->dropForeign(['status_logs_id']);
        });
    }
};