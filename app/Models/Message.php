<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Message extends Model
{
    use HasFactory;

    protected $appends = [
        'name',
        'me',
        'picture'
    ];


    public function getNameAttribute()
    {
        $user = User::find($this->user_id);
        return $user ? $user->name : 'Sem nome';
    }

    public function getMeAttribute()
    {
        return $this->user_id === Auth::id() ? true : false;
    }

    public function getPictureAttribute()
    {
        $user = User::find($this->user_id);
        return $user ? $user->picture : 0;
    }
}
