<?php
namespace CookieTime\Janitor\Observer;

use CookieTime\Janitor\Contract\Strategy;
use CookieTime\Janitor\Models\Ability;

class AbilityObserver {

    protected $strategy;

    public function __construct(Strategy $strategy)
    {
        $this->strategy = $strategy;
    }
    /**
     * 新创建完成分配权限值
     * @param Ability $ability
     */
    public function created(Ability $ability)
    {
        $ability->keyCode = $this->strategy->generateKeyCode($ability->id - 1);
        $ability->update();
    }
}