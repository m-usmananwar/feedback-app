<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'commentable_type',
        'commentable_id',
        'content',
        'user_id',
    ];

    public static $commentableTypes = ["Feedback"];

    //Model Relations

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    //Model Scopes

    public function scopeFilters($query, $data = [])
    {
        $query->when(!empty($data['user_id']), function($q) use($data) {
            $q->where('user_id', $data['user_id']);
        });
        $query->when(!empty($data['commentable_type']), function($q) use($data) {
            $q->where('commentable_type', $data['commentable_type']);
        });
        $query->when(!empty($data['commentable_id']), function($q) use($data) {
            $q->where('commentable_id', $data['commentable_id']);
        });

        return $query;
    }

    public function scopeListingInfo($query)
    {
        return $query->with('user');
    }

    public function scopeSingleInfo($query)
    {
        return $query->listingInfo();
    }
}
