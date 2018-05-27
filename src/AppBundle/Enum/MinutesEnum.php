<?php

namespace AppBundle\Enum;


/**
 * @author mathil <github.com/mathil>
 */
class MinutesEnum
{

    /**
     * @return array
     */
    public static function getMinutes(): array
    {
        return [
            '00' => 0,
            '15' => 15,
            '30' => 30,
            '45' => 45,
        ];
    }


}