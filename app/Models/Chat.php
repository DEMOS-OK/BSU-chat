<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Chat extends Model
{
    use HasFactory;

    /**
     * Table related with the model
     *
     * @var string
     */
    protected $table = 'chats';

    /**
     * Array with the fillable model attributes
     *
     * @var string[]
     */
    protected $fillable = ['title'];

    /**
     * Many To Many relations with User model
     *
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'messages');
    }

    /**
     * One To Many relation with the Message model
     *
     * @return HasMany
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}
