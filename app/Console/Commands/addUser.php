<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class addUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add Pengguna Aplikasi';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = new \App\Models\User();
        $user->name = 'Admin';
        $user->email = 'riyenperdana@uin-suska.ac.id';
        $user->password = bcrypt('admin');
        $user->save();
    }
}
