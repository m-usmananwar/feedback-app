<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'category',
        'description',
    ];

    //Model Relations

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    //Model Scopes

    public function scopeFilters($query, $data = [])
    {
        $query->when(!empty($data['user_id']), function ($q) use ($data) {
            $q->where('user_id', $data['user_id']);
        });
        $query->when(!empty($data['category']), function ($q) use ($data) {
            $q->where('category', $data['category']);
        });
        $query->when(!empty($data['title']), function ($q) use ($data) {
            $q->where('title', $data['title']);
        });
        return $query;
    }

    public function scopeListingInfo($query)
    {
        return $query->withCount('comments')->with('user');
    }

    public function scopeSingleInfo($query)
    {
        return $query->withCount('comments')->with('user');
    }
}

