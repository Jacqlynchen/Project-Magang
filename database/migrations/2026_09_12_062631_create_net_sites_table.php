<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('net_sites', function (Blueprint $table) {

            $table->id();

            $table->string('name');
            $table->text('address')->nullable();

            $table->decimal('lat', 10, 7)->nullable();
            $table->decimal('long', 10, 7)->nullable();

            $table->string('sid')->nullable();
            $table->string('ip_segment')->nullable();

            $table->string('speed')->nullable();
            $table->decimal('amount', 15, 2)->nullable();

            $table->string('branch_id');

            $table->foreign('branch_id')
                ->references('id')
                ->on('branches')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('pri_vendor_id')
                ->nullable()
                ->constrained('vendors')
                ->nullOnDelete();

            $table->foreignId('sec_vendor_id')
                ->nullable()
                ->constrained('vendors')
                ->nullOnDelete();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('net_sites');
    }
};