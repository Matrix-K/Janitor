<?php
namespace CookieTime\Janitor\Models;

trait JanitorUserTrait
{
    public function roles(){
        return $this->belongsToMany('CookieTime\Janitor\Models\Role','janitor_assign_roles','user_id','role_id');
    }

    public function permissionsSummary()
    {
        return $this->hasOne(PermissionsSummary::class);
    }
}