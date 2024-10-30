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
        Schema::table('asset', function (Blueprint $table) {
            $table->text('asset_alamat')->nullable()->after('asset_slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('asset', function (Blueprint $table) {
            $table->dropColumn('asset_alamat');
        });
    }
};
