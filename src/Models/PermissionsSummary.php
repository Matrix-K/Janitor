<?php
namespace CookieTime\Janitor\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class PermissionsSummary extends Model {

    protected $table = 'janitor_permission_summary';
    protected $fillable = ['user_id','role_id','platformKeyCode', 'resourceTypeKeyCode', 'resourceKeyCode', 'apiMethodKeyCode', 'resourceFieldsKeyCode'];

    public function user()
    {
        return $this->belongsTo(config('janitor.userModel'));
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}