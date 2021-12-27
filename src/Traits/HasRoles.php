<?php

namespace Jawadabbass\LaravelPermissionUuid\Traits;

trait HasRoles
{

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    public function getUserRoleIds()
    {
        $roleIdsArray = [];
        if ($this->roles->count() > 0) {
            $roles = $this->roles;
            foreach ($roles as $role) {
                $roleIdsArray[] = $role->id;
            }
        }
        return $roleIdsArray;
    }

}
