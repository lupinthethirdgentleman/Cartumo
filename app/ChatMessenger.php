<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class ChatMessenger extends Model
{
    public function getUserName($user_id) {

        return User::find($user_id);
    }
}
