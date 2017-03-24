<?php
namespace CookieTime\Janitor\Strategy;

use CookieTime\Janitor\Contract\Strategy;

class PrimeKeyCode implements Strategy {

    public function generateKeyCode($id)
    {
        if ($id == 1) {
            return 2;
        }
        $n = 10000; // 求10000以内的  不过可用的就131个
        $result = [2];
        $next = 1;
        while (true) {
            $next = $next + 2;
            if ($next >= $n) {
                break;
            }
            $flag = false;
            foreach ($result as $x) {
                if ($x > sqrt($next)) {
                    $flag = true;
                    break;
                }
                $Modulo = $next % $x;
                if ($Modulo == 0) {
                    break;
                }
            }

            if ($flag) {
                $result[] = $next;
                if (count($result) == $id) {
                    return $next;
                }
            }
        }
    }

    public function parseKeyCode($keyCode)
    {
        $codes = [];
        for ($i = 2; $i <= $keyCode; $i++) {
            while ($keyCode <> $i) {
                if ($keyCode % $i == 0) {
                    array_push($codes,$i);
                    $keyCode /= $i;
                } else {
                    break;
                }
            }
        }

        return $codes;
    }

    public function verify($abilityKeyCode, $keyCode)
    {
        return $keyCode%$abilityKeyCode == 0;
    }

    public function keyCodeCalculation(array $keyCodeCollection)
    {
        return array_product($keyCodeCollection);
    }
}