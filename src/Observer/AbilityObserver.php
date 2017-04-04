<?php
namespace CookieTime\Janitor\Observer;

use CookieTime\Janitor\Contract\Strategy;
use CookieTime\Janitor\Models\Ability;

class AbilityObserver{

    protected $strategy;

    public function __construct(Strategy $strategy)
    {
        $this->strategy = $strategy;
    }
    
    /**
     * 创建之前
     * @param Ability $ability
     */
    public function creating(Ability $ability)
    {
        $count = Ability::where('type',$ability->type)->count();
        $ability->keyCode = $this->strategy->generateKeyCode($count);
    }
}