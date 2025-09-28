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
        Schema::create('member_pakets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id'); // Kolom member_id sebagai foreign key
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->unsignedInteger('paket_id');  // Kolom paket_id bertipe integer (disesuaikan)
            $table->foreign('paket_id')->references('id')->on('pakets')->onDelete('cascade');
            $table->enum('status', ['pending', 'paid']);
            $table->string('order_id')->nullable();
            $table->date('tanggalmulai')->nullable()->change();
            $table->date('tanggalakhir')->nullable()->change();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_pakets');
    }
};
