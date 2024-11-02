<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    protected $guarded = [];

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    public function created_by(): BelongsTo
    {
//        $name = $this->belongsTo(User::class)->first()->name;
        return $this->belongsTo(User::class);
    }
}
