<?php

namespace CookieTime\Janitor\Strategy;

use CookieTime\Janitor\Contract\Strategy;

/**
 * 位与运算计算权限
 * 优点:运算速度快
 * 缺点:存储空间占用大 受计算机硬件限制 32位 31个权限  64位 63个权限
 * @package CookieTime\Janitor\Strategy
 */
class BitAndKeyCode implements Strategy{

    /**
     * 生成 KeyCode
     * @param $id
     * @return bool|number
     */
    public function generateKeyCode($id)
    {
        return pow(2, $id);
    }

    /**
     * parse keyCode
     * @param $keyCode
     * @return array
     */
    public function parseKeyCode($keyCode)
    {
        $binary = decbin($keyCode);

        $array = [];

        $isLoop = true;

        $step = 0;

        while ($isLoop) {
            $value = pow(2, $step) * ($binary % 10);
            if ($value != 0) {
                $array[] = $value;
            }
            $step ++;
            $binary = $binary / 10;
            if ($binary == 0) {
                $isLoop = false;
            }
        }

        return $array;
    }

    /**
     * 权限验证方法
     * @param $abilityKeyCode
     * @param $keyCode
     * @return bool
     */
    public function verify($abilityKeyCode,$keyCode)
    {
        if (intval($keyCode) & $abilityKeyCode) {
            return true;
        }

        return false;
    }

    /**
     * 权限计算方法
     * @param array $keyCodeCollection
     * @return number
     */
    public function keyCodeCalculation(array $keyCodeCollection)
    {
        return array_sum($keyCodeCollection);
    }
}