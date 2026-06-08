<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengaduan extends Model
{
    protected $fillable = [
        'user_id',
        'desa_id',
        'rtrw_id',
        'latitude',
        'longitude',
        'lokasi_spesifik',
        'deskripsi',
        'foto',
        'status',
    ];

    protected $casts = [
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function desa(): BelongsTo
    {
        return $this->belongsTo(Desa::class);
    }

    public function rtrw(): BelongsTo
    {
        return $this->belongsTo(Rtrw::class);
    }
}