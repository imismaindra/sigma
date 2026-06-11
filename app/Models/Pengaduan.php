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
        'judul',
        'isi_pengaduan',
        'status',
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
}
