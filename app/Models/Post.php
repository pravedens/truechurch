<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'posts';

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }

    public function conference(): BelongsTo
    {
        return $this->belongsTo(Conference::class, 'conference_id', 'id');
    }
}

