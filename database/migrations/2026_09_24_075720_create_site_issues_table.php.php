<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_issues', function (Blueprint $table) {
            $table->id();

            $table->foreignId('net_site_id')
                ->constrained('net_sites')
                ->cascadeOnDelete();

            $table->foreignId('net_issue_id')
                ->constrained('net_issues');

            $table->foreignId('employee_id')
                ->nullable()
                ->constrained('employees')
                ->nullOnDelete();

            // Optional free-text note about the report — may be left empty.
            $table->string('remark')->nullable();

            $table->unsignedBigInteger('status_logs_id')->nullable();

            $table->timestamps();

            $table->foreign('status_logs_id')
                ->references('id')->on('status_logs')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_issues');
    }
};