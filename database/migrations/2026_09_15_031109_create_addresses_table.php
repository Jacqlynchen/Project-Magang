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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->string('addr_1')->nullable();
            $table->string('addr_2')->nullable();
            $table->string('addr_3')->nullable();

            // Polymorphic link — modelable_id is a string because
            // Branch's primary key ("id") is a string (e.g. "BR001"),
            // not an auto-incrementing integer.
            $table->string('modelable_id', 45);
            $table->string('modelable_type', 45);

            $table->timestamps();

            $table->index(['modelable_id', 'modelable_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};