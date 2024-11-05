<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    public function created_by(): BelongsTo
    {
//        $name = $this->belongsTo(UserComponent::class)->first()->name;
        return $this->belongsTo(User::class);
    }
}
