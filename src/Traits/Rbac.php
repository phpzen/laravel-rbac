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
        $roles = $this->roles()->pluck('slug')->toArray();
        if(false !== strpos($role, '|')) {
            $roleArr = explode('|', $role);
        } else {
            $roleArr = [$role];
        }
        return !empty(array_intersect($roleArr, $roles));
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
            $permissions = array_merge($permissions, $role->permissions()->pluck('slug')->toArray());
        }
        $permissions = array_unique($permissions);
        if(false !== strpos($operation, '|')) {
            $operationArr = explode('|', $operation);
        } else {
            $operationArr = [$operation];
        }
        return !empty(array_intersect($operationArr, $permissions));
    }
}
