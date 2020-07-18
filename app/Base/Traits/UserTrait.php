<?php

namespace App\Base\Traits;

use App\Base\Models\Role;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait UserTrait {

    /**
     * @return BelongsToMany roles
     */
    public function roles() {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function havePermission ($permissions) {
        foreach ($this->roles as $role) {
            if ($role['full-access'] == 'yes') {
                return 'true';
            }
            foreach ($role->permissions as $permission) {
                if ($permission->slug == $permissions) {
                    return 'true';
                }
            }
        }
        return 'false';
    }

}
