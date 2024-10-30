<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'client_jns',
        'client_id',
        'client_nm',
        'client_jk',
        'client_alamat',
        'client_email',
        'client_telp'
    ];

    protected $table = 'client';

}
