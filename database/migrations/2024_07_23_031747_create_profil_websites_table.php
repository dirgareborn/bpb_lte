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
        Schema::create('profil_websites', function (Blueprint $table) {
            $table->id();
            $table->longText('maps')->nullable();
            $table->longText('alamat')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('telepon')->nullable();
            $table->string('email')->nullable();
            $table->longText('file_struktur_organisasi')->nullable();
            $table->longText('file_logo')->nullable();
            $table->longText('sambutan')->nullable();
            $table->json('socialmedia')->nullable();
            $table->longText('visi')->nullable();
            $table->longText('misi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_websites');
    }
};
