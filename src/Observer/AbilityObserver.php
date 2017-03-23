<?php
namespace CookieTime\Janitor\Observer;

use CookieTime\Janitor\Models\Ability;
use CookieTime\Janitor\Strategy\KeyCode;

class AbilityObserver
{
    use KeyCode;
    /**
     * 新创建完成分配权限值
     * @param Ability $ability
     */
    public function created(Ability $ability)
    {
        if($ability->id)
        {
            $ability->keyCode = $this->generateKeyCode($ability->id - 1);
            $ability->update();
        }
    }
}