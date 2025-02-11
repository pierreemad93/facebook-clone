<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    //
    protected $fillable = ["content", "status", "slug", "user_id"];
    /**
     * Get the user for the posts.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    /**
     * local scope for search  the post.
     */
    public function scopeSearch(Builder $query, $search)
    {
        return $query->where('content', 'like', "%$search%")
            ->orWhere('status', 'like', "%$search%")
            ->orWhereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%");
            });
    }

    // Local Scope for Filtering by Status
    public function scopeFilterByStatus(Builder $query, $status = null)
    {
        if (!empty($status)) {
            return $query->orWhere('status', $status);
        }
        return $query;
    }
}
