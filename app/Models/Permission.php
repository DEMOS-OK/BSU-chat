<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

final class Permission extends Model
{
    /**
     * Table related with the model
     *
     * @var string
     */
    protected $table = 'permissions';

    /**
     * Array of the fillable attributes
     *
     * @var array
     */
    protected $fillable = ['title'];

    /**
     * Relations Many To Many with Role model
     *
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'xref_roles_permissions');
    }
}
