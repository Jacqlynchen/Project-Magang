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
        Schema::table('net_sites', function (Blueprint $table) {
            $table->string('addr_1')->nullable()->after('name');
            $table->string('addr_2')->nullable()->after('addr_1');
            $table->string('addr_3')->nullable()->after('addr_2');

            $table->dropColumn('address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('net_sites', function (Blueprint $table) {
            $table->text('address')->nullable()->after('name');

            $table->dropColumn(['addr_1', 'addr_2', 'addr_3']);
        });
    }
};