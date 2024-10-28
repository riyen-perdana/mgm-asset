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
        Schema::create('asset', function (Blueprint $table) {
            $table->id();
            $table->string('asset_kd')->unique()->comment('Kode Asset UIN SUSKA Riau');
            $table->string('asset_nm')->comment('Nama Asset UIN SUSKA Riau');
            $table->string('asset_slug')->comment('Slug Asset UIN SUSKA Riau');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset');
    }
};
