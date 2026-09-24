<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('status_logs', function (Blueprint $table) {
            $table->id();
            $table->string('remark')->nullable();
            $table->foreignId('status_id')->constrained('statuses');
            $table->unsignedBigInteger('users_id')->nullable();
            $table->foreign('users_id')->references('id')->on('users')->nullOnDelete();

            // Polymorphic link — modelable_id is a string because
            // Branch's primary key is a string (UUID), while NetSite's
            // is an auto-incrementing integer.
            $table->string('modelable_id', 45);
            $table->string('modelable_type', 45);

            $table->timestamps();

            $table->index(['modelable_id', 'modelable_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('status_logs');
    }
};