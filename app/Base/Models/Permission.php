<?php

namespace App\Base\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'description',
    ];

    /**
     * @return BelongsToMany Roles
     */
    public function roles() {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
}
