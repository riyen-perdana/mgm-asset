<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Unit extends Model
{
    protected $table = 'unit';
    protected $fillable = ['unit_kd', 'unit_nm'];

    public function asset():HasMany
    {
        return $this->hasMany(Asset::class);
    }
}
