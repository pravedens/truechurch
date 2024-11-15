<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;

class Conference extends Model
{
    use HasFactory, HasApiTokens;

    protected $guarded = [];

    public function post(): HasMany
    {
        return $this->hasMany(Post::class, 'conference_id', 'id');
    }
}
