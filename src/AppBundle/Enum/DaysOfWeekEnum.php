<?php

namespace AppBundle\Enum;


/**
 * @author mathil <github.com/mathil>
 */
class DaysOfWeekEnum
{

    /**
     * @return array
     */
    public static function getDaysOfWeek(): array
    {
        return [
            'bm.global.monday' => 1,
            'bm.global.tuesday' => 2,
            'bm.global.wednesday' => 3,
            'bm.global.thursday' => 4,
            'bm.global.friday' => 5,
            'bm.global.saturday' => 6,
            'bm.global.sunday' => 7,
        ];
    }


}