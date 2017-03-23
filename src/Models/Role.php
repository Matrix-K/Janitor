<?php
namespace CookieTime\Janitor\Models;

use CookieTime\Janitor\Strategy\KeyCode;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use KeyCode;

    protected $table = 'janitor_roles';

    protected $fillable = ['name', 'description', 'keyCode'];

    public function users()
    {
        return $this->belongsToMany('\App\User','janitor_assign_roles','role_id','user_id')->wherePivot('forbidden',0);
    }
}