<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pengaduan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pengaduan';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_pengaduan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_user',
        'id_kategori',
        'ticket_number',
        'judul',
        'isi_pengaduan',
        'status',
        'priority',
        'due_at',
        'cancelled_at',
        'cancel_reason',
        'completed_confirmed_at',
        'reopened_at',
        'completion_note',
    ];

    protected $casts = [
        'due_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'completed_confirmed_at' => 'datetime',
        'reopened_at' => 'datetime',
    ];

    /**
     * Get the user who submitted the complaint.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    /**
     * Get the category of the complaint.
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriPengaduan::class, 'id_kategori', 'id_kategori');
    }

    /**
     * Get the attachments for this complaint.
     */
    public function lampiran(): HasMany
    {
        return $this->hasMany(Lampiran::class, 'id_pengaduan', 'id_pengaduan');
    }

    /**
     * Get the status logs for this complaint.
     */
    public function statusLogs(): HasMany
    {
        return $this->hasMany(StatusLog::class, 'id_pengaduan', 'id_pengaduan');
    }

    /**
     * Get the responses/feedback for this complaint.
     */
    public function tanggapan(): HasMany
    {
        return $this->hasMany(Tanggapan::class, 'id_pengaduan', 'id_pengaduan');
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class, 'id_pengaduan', 'id_pengaduan');
    }

    public function activities(): HasMany
    {
        return $this->hasMany(ActivityLog::class, 'id_pengaduan', 'id_pengaduan');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(PengaduanComment::class, 'id_pengaduan', 'id_pengaduan');
    }

    public function isEditable(): bool
    {
        return $this->status === 'pending' && $this->cancelled_at === null;
    }

    public function isOverdue(): bool
    {
        return $this->due_at !== null
            && $this->due_at->isPast()
            && !in_array($this->status, ['selesai', 'ditolak'], true)
            && $this->cancelled_at === null;
    }

    /**
     * Get the date and time when the complaint was first processed.
     */
    public function getWaktuProsesAttribute()
    {
        $log = $this->statusLogs->where('status_baru', 'proses')->first();
        return $log ? $log->created_at : null;
    }

    /**
     * Get the date and time when the complaint was resolved or rejected.
     */
    public function getWaktuSelesaiDitolakAttribute()
    {
        $log = $this->statusLogs->whereIn('status_baru', ['selesai', 'ditolak'])->first();
        return $log ? $log->created_at : null;
    }

    /**
     * Get the processing duration format (Indonesian).
     */
    public function getDurasiProsesAttribute(): ?string
    {
        $waktuProses = $this->waktu_proses;

        // If it was never processed (never reached 'proses' status)
        if (!$waktuProses) {
            // Check if it went directly to selesai/ditolak
            if (in_array($this->status, ['selesai', 'ditolak'])) {
                $waktuProses = $this->created_at; // fallback to creation time
            } else {
                return 'Belum diproses';
            }
        }

        if (in_array($this->status, ['selesai', 'ditolak'])) {
            $end = $this->waktu_selesai_ditolak ?? $this->updated_at;
        } else {
            $end = now();
        }

        if ($end->lt($waktuProses)) {
            return '0 menit';
        }

        $diff = $waktuProses->diff($end);

        $parts = [];
        if ($diff->d > 0) {
            $parts[] = $diff->d . ' hari';
        }
        if ($diff->h > 0) {
            $parts[] = $diff->h . ' jam';
        }
        if ($diff->i > 0) {
            $parts[] = $diff->i . ' menit';
        }

        if (empty($parts)) {
            return $diff->s . ' detik';
        }

        $formatted = implode(', ', $parts);

        if (!in_array($this->status, ['selesai', 'ditolak'])) {
            return 'Sedang diproses (sudah berjalan ' . $formatted . ')';
        }

        return $formatted;
    }

    /**
     * Get the total resolution duration from report submission (lapor) to completion/resolution.
     */
    public function getDurasiPenyelesaianAttribute(): ?string
    {
        $start = $this->created_at;

        if (in_array($this->status, ['selesai', 'ditolak'])) {
            $end = $this->waktu_selesai_ditolak ?? $this->updated_at;
        } else {
            $end = now();
        }

        if ($end->lt($start)) {
            return '0 menit';
        }

        $diff = $start->diff($end);

        $parts = [];
        if ($diff->d > 0) {
            $parts[] = $diff->d . ' hari';
        }
        if ($diff->h > 0) {
            $parts[] = $diff->h . ' jam';
        }
        if ($diff->i > 0) {
            $parts[] = $diff->i . ' menit';
        }

        if (empty($parts)) {
            return $diff->s . ' detik';
        }

        $formatted = implode(', ', $parts);

        if (!in_array($this->status, ['selesai', 'ditolak'])) {
            return 'Belum selesai (sudah berjalan ' . $formatted . ')';
        }

        return $formatted;
    }
}
