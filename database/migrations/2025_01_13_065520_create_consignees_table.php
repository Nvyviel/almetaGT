<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consignees', function (Blueprint $table) {
            $table->id();
            // $table->string('consignee_id')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('industry');
            $table->string('name_consignee');
            $table->enum('city', ['surabaya', 'pontianak', 'semarang', 'banjarmasin', 'sampit', 'jakarta', 'kumai', 'samarinda', 'balikpapan', 'berau', 'palu', 'bitung', 'gorontalo', 'ambon']);
            $table->string('email')->unique();
            $table->bigInteger('phone_number');
            $table->text('consignee_address');
            $table->string('npwp')->nullable();
            $table->string('ktp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consignees');
    }
};
