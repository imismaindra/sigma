<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengaduan', function (Blueprint $table) {
            $table->string('ticket_number', 30)->nullable()->unique()->after('id_pengaduan');
            $table->string('priority', 20)->default('sedang')->after('status');
            $table->timestamp('completed_confirmed_at')->nullable()->after('cancel_reason');
            $table->timestamp('reopened_at')->nullable()->after('completed_confirmed_at');
            $table->text('completion_note')->nullable()->after('reopened_at');
        });

        DB::table('pengaduan')
            ->whereNull('ticket_number')
            ->orderBy('id_pengaduan')
            ->get(['id_pengaduan', 'created_at'])
            ->each(function ($item, $index) {
                $year = $item->created_at ? date('Y', strtotime($item->created_at)) : now()->format('Y');
                DB::table('pengaduan')
                    ->where('id_pengaduan', $item->id_pengaduan)
                    ->update([
                        'ticket_number' => 'PGD-' . $year . '-' . str_pad((string) ($index + 1), 5, '0', STR_PAD_LEFT),
                    ]);
            });

        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE pengaduan MODIFY status ENUM('pending','proses','menunggu_klarifikasi','ditindaklanjuti','menunggu_verifikasi_mahasiswa','selesai','ditolak') DEFAULT 'pending'");
        }
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE pengaduan MODIFY status ENUM('pending','proses','selesai','ditolak') DEFAULT 'pending'");
        }

        Schema::table('pengaduan', function (Blueprint $table) {
            $table->dropUnique(['ticket_number']);
            $table->dropColumn([
                'ticket_number',
                'priority',
                'completed_confirmed_at',
                'reopened_at',
                'completion_note',
            ]);
        });
    }
};
