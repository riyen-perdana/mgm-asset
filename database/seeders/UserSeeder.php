<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->nip = '198111162011011010';
        $user->name = 'Admin';
        $user->email = 'riyenperdana@uin-suska.ac.id';
        $user->password = bcrypt('password');
        $user->glr_blk = 'ST';
        $user->no_telp = '082170237327';
        $user->save();
    }
}
