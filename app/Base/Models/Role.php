<?php

namespace App\Base\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'description', 'full-access'
    ];

    /**
     * @return BelongsToMany permissions
     */
    public function permissions() {
        return $this->belongsToMany(Permission::class)->withTimestamps();
    }

    /**
     * @return BelongsToMany users
     */
    public function users() {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
