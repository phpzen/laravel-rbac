<?php

namespace PHPZen\LaravelRbac\Traits;

trait Rbac
{
    public function roles()
    {
        return $this->belongsToMany('PHPZen\LaravelRbac\Model\Role')->withTimestamps();
    }

    /**
     * @param string $role
     * @return bool
     */
    public function hasRole($role)
    {
        $roles = $this->roles()->lists('slug')->toArray();
        return in_array($role, $roles);
    }

    /**
     * @param string $operation
     * @return bool
     */
    public function canDo($operation)
    {
        $roles = $this->roles;
        $permissions = [];
        foreach ($roles as $role) {
            $permissions = array_merge($permissions, $role->permissions()->lists('slug')->toArray());
        }
        $permissions = array_unique($permissions);
        return in_array($operation, $permissions);
    }
}