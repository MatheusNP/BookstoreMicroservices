<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class PopulateUser extends Command
{
    protected $name = 'populate:user';

    protected $description = 'populate users table';

    public function handle()
    {
        $users = [
            ['username' => 'admin', 'password' => Hash::make('password')],
            ['username' => 'matheus', 'password' => Hash::make('matheus')],
        ];

        foreach ($users as $data) {
            $user = User::create($data);
        }
    }
}
