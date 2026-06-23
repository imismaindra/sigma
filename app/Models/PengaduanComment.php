<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengaduanComment extends Model
{
    protected $table = 'pengaduan_comments';

    protected $primaryKey = 'id_comment';

    protected $fillable = [
        'id_pengaduan',
        'id_user',
        'message',
    ];

    public function pengaduan(): BelongsTo
    {
        return $this->belongsTo(Pengaduan::class, 'id_pengaduan', 'id_pengaduan');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
