<?php

namespace CookieTime\Janitor\Strategy;

trait KeyCode {

    /**
     * 生成 KeyCode
     * @param $id
     * @return bool|number
     */
    public function generateKeyCode($id)
    {
        if (!is_int($id)) {
            return false;
        }

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
}