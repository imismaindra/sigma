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
        Schema::table('pengaduan', function (Blueprint $table) {
            $table->timestamp('due_at')->nullable()->after('status');
            $table->timestamp('cancelled_at')->nullable()->after('due_at');
            $table->text('cancel_reason')->nullable()->after('cancelled_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengaduan', function (Blueprint $table) {
            $table->dropColumn(['due_at', 'cancelled_at', 'cancel_reason']);
        });
    }
};
