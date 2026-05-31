<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Desa extends Model
{
    protected $fillable = ['nama_desa'];

    public function rtrws(): HasMany
    {
        return $this->hasMany(Rtrw::class);
    }
}