<?php

namespace App\Base\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

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

    public function getNameAttribute($value) {
        return $this->name = Str::ucfirst($value);
    }
}
