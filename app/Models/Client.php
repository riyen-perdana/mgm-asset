<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\JenisRelasi;

class Client extends Model
{

    protected $table = 'client';
    protected $fillable = ['client_jns', 'client_id', 'client_nm', 'client_jk', 'client_alamat', 'client_email', 'client_telp'];

    protected $casts = [
        'client_jns' => JenisRelasi::class
    ];  
}
