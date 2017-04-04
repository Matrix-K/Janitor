<?php
namespace CookieTime\Janitor\Models;

use Illuminate\Database\Eloquent\Model;

class Ability extends Model {
    protected $table = 'janitor_abilities';
    protected $fillable = ['name', 'description', 'type', 'keyCode'];
}