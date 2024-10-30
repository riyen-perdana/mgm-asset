<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
<<<<<<< HEAD
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

=======
    protected $table = 'client';
    protected $fillable = ['client_jns', 'client_id', 'client_nm', 'client_jk', 'client_alamat', 'client_email', 'client_telp'];
>>>>>>> bc8ba68e58f533b1eca4eb76323b716188b23c10
}
