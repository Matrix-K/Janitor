<?php
namespace CookieTime\Janitor\Models;

use CookieTime\Janitor\Strategy\KeyCode;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'janitor_roles';

    protected $fillable = ['name', 'description', 'keyCode'];

    public function users()
    {
        return $this->belongsToMany(config('janitor.userModel'),'janitor_assign_roles','role_id','user_id');
    }

    public function permissionsSummary()
    {
        return $this->hasOne(PermissionsSummary::class);
    }
}