<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class congress_leaders extends Model
{
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
