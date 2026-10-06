<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->unique();
            $table->string('name');
            $table->unsignedBigInteger('position_id')->nullable();
            $table->string('position_title')->nullable();

            // Intentionally NOT a foreign key — this mimics data that
            // arrives from an external HR system, which only knows the
            // branch's public "code", not our internal branch id (UUID).
            $table->string('branch_code')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};