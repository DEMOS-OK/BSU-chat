<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Message extends Model
{
    use HasFactory;

    /**
     * Table related with the model
     *
     * @var string
     */
    protected $table = 'messages';

    /**
     * Array with the fillable model attributes
     *
     * @var string[]
     */
    protected $fillable = ['text', 'user_id', 'chat_id'];

    /**
     * Additional attributes
     *
     * @var string[]
     */
    protected $appends = [
        'author'
    ];

    /**
     * Relations One To Many with User model
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Getter for the custom attribute
     *
     * @return mixed
     */
    public function getAuthorAttribute(): mixed
    {
        return $this->user->name;
    }

    /**
     * Accessor for the created_at attrubite
     *
     * @param $value
     * @return mixed
     */
    public function getCreatedAtAttribute($value): mixed
    {
        return Carbon::make($value)?->format('Y-m-d H:i');
    }

    /**
     * Message is not created for Many To Many with User and Chat
     *
     * @param $query
     * @return mixed
     */
    public function scopeNoRelation($query): mixed
    {
        return $query->where('text', '!=', '');
    }
}
