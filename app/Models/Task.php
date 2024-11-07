<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Task extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function contractor(): BelongsTo
    {
        return $this->belongsTo(Contractor::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function userComments($id): HasMany
    {
        return $this->hasMany(Comment::class)->where('created_by', '=', $id);
    }

    public function parent(): Task
    {
        return Task::where('parent_id', '=', $this->id);
    }

    public function subtasks(): Collection
    {
        return Task::where('parent_id' , '=', $this->id)->get();
    }

    public function isDaughter() :bool
    {
        return $this->parent_id != null;
    }

    public function isParent() :bool
    {
        return Task::where('parent_id', '=', $this->id)->exists();
    }
}
