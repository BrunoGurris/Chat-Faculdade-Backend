<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $appends = [
        'name'
    ];


    public function getNameAttribute()
    {
        $user = User::find($this->user_id);
        return $user ? $user->name : 'Sem nome';
    }
}
