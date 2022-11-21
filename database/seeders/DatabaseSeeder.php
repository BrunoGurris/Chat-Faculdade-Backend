<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $user = new User();
        $user->username = 'bruno';
        $user->name = mb_strtoupper('BRUNO ALEXANDRE');
        $user->password = Hash::make('12345');
        $user->save();
    }
}
