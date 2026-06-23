<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaduan_comments', function (Blueprint $table) {
            $table->id('id_comment');
            $table->unsignedBigInteger('id_pengaduan');
            $table->unsignedBigInteger('id_user');
            $table->text('message');
            $table->timestamps();

            $table->foreign('id_pengaduan')->references('id_pengaduan')->on('pengaduan')->cascadeOnDelete();
            $table->foreign('id_user')->references('id_user')->on('users')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaduan_comments');
    }
};
