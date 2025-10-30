<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class congress_leaders extends Model
{
    use HasFactory;

    protected $fillable = [
        'photo_url',
        'name',
        'position',
        'bio',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
