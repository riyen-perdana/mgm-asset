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
        Schema::create('client', function (Blueprint $table) {
            $table->id();
            $table->enum('client_jns',['mahasiswa','tendik','dosen','umum'])->comment('Jenis Client Mahasiswa, Pegawai, dll');
            $table->string('client_id')->unique()->comment('Tanda Pengenal Mahasiswa, Pegawai, dll');
            $table->string('client_nm')->comment('Nama Mahasiswa, Pegawai, dll');
            $table->enum('client_jk', ['L', 'P'])->comment('Jenis Kelamin Mahasiswa, Pegawai, dll');
            $table->string('client_alamat')->comment('Alamat Mahasiswa, Pegawai, dll');
            $table->string('client_email')->unique()->comment('Email Mahasiswa, Pegawai, dll');
            $table->string('client_telp')->comment('Nomor Telepon Mahasiswa, Pegawai, dll');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client');
    }
};
