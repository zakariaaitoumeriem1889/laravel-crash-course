<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Post
 * @package App\Models
 */
class Post extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'body'
    ];

    /**
     * @param User $user
     * @return mixed
     */
    public function likedBy(User $user)
    {
        return $this->likes->contains('user_id', $user->id);
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
