<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Asset extends Model
{
    protected $table = 'asset';
    protected $fillable = [
        'asset_kd',
        'asset_nm',
        'asset_slug',
        'asset_almt',
        'asset_jml',
        'unit_id',
    ];

    public function unit():BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }
}
