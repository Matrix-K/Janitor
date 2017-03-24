<?php

namespace CookieTime\Janitor\Contract;

interface Strategy
{
    public function generateKeyCode($id);

    public function parseKeyCode($keyCode);

    public function verify($abilityKeyCode,$keyCode);

    public function keyCodeCalculation(array $keyCodeCollection);
}