<?php

namespace AppBundle\Enum;


/**
 * @author mathil <github.com/mathil>
 */
class DaysOfMonthEnum
{

    /**
     * @return array
     */
    public static function getDaysOfMonth(): array
    {
        $result = [];
        for ($i = 1; $i <= 31; $i++) {
            $result[$i] = $i;
        }

        return $result;
    }


}