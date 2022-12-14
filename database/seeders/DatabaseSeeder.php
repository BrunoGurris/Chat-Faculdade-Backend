<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Message;
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
        $user->password = Hash::make('123');
        $user->picture = 0;
        $user->save();

        $user2 = new User();
        $user2->username = 'rebeca';
        $user2->name = mb_strtoupper('REBECA PEDROSO');
        $user2->password = Hash::make('123');
        $user->picture = 1;
        $user2->save();

        $message = new Message();
        $message->user_id = 1;
        $message->message = 'Olá';
        $message->save();

        $message2 = new Message();
        $message2->user_id = 1;
        $message2->message = 'Olá Denovo';
        $message2->save();
    }
}
