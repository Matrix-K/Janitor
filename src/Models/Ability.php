<?php
namespace CookieTime\Janitor\Models;

use Illuminate\Database\Eloquent\Model;

class Ability extends Model {
    protected $table = 'janitor_abilities';
    protected $fillable = ['name', 'description', 'ability_prefix', 'ability_attribute', 'ability_attribute_value'];
}