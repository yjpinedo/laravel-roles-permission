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
     * @return BelongsToMany
     */
    public function users() {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
