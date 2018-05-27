<?php

namespace AppBundle\Enum;


/**
 * @author mathil <github.com/mathil>
 */
class HoursEnum
{

    /**
     * @return array
     */
    public static function getHours(): array
    {
        $result = [];
        for ($i = 0; $i <= 23; $i++) {
            $result[$i] = $i;
        }

        return $result;
    }


}