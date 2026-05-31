<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rtrw extends Model
{
    protected $fillable = ['desa_id', 'rt', 'rw'];

    public function desa(): BelongsTo
    {
        return $this->belongsTo(Desa::class);
    }
}