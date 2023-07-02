<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

final class Role extends Model
{
    /**
     * Table related with the model
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * Array of the fillable attributes
     *
     * @var array
     */
    protected $fillable = ['title'];

    /**
     * Relations Many To Many with Permission model
     *
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'xref_roles_permissions');
    }
}
