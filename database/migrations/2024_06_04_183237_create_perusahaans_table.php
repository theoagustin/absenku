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
        Schema::create('perusahaan', function (Blueprint $table) {
            $table->id();
        $table->string('nama_perusahaan');
        $table->text('alamat');
        $table->string('telp');
        $table->string('bidang');
        $table->string('owner');
        $table->string('email');
        $table->string('latitude');
        $table->string('langitude');
        $table->string('approv');
        $table->string('idusers');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perusahaan');
    }
};
