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
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->bigIncrements('id_activity');
            $table->unsignedBigInteger('id_user')->nullable();
            $table->unsignedBigInteger('id_pengaduan')->nullable();
            $table->string('action', 80);
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('users')->nullOnDelete();
            $table->foreign('id_pengaduan')->references('id_pengaduan')->on('pengaduan')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
