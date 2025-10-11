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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('kelamin', ['pria', 'wanita']);
            $table->string('no_hp');
            $table->string('tempat_tinggal')->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('email_kedua');
            $table->string('karakter')->nullable();
            $table->string('karakter_pasangan')->nullable();
            $table->string('hafalan_surat')->nullable();
            $table->enum('is_active', ['0', '1'])->default('1');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
