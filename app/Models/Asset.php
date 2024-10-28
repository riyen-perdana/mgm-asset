<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $table = 'asset';
    protected $fillable = [
        'asset_kd',
        'asset_nm',
        'asset_slug',
    ];
}
