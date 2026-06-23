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
        Schema::create('notifications', function (Blueprint $table) {
            $table->bigIncrements('id_notification');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_pengaduan')->nullable();
            $table->string('title', 120);
            $table->text('message');
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('id_pengaduan')->references('id_pengaduan')->on('pengaduan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
