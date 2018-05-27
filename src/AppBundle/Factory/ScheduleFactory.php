<?php
/**
 * Created by PhpStorm.
 * User: mateusz
 * Date: 18.05.18
 * Time: 21:21
 */

namespace AppBundle\Factory;

use AppBundle\Entity\Schedule;
use DateTime;
use Symfony\Component\Form\Form;


/**
 * @author mathil <github.com/mathil>
 */
class ScheduleFactory
{

    /**
     * @param array $array
     *
     * @return Schedule
     */
    public function createFromArray(array $array): Schedule
    {
        dump($array);
        $schedule = new Schedule();
        $schedule->setDateFrom(new DateTime($array['dateFrom'].' 00:00:00'));
        $schedule->setDateTo(new DateTime($array['dateTo'].' 23:59:59'));
        $schedule->setDaysOfWeek(implode(',', $array['daysOfWeek']));
        $schedule->setDaysOfMonth(implode(',', $array['daysOfMonth']));
        $schedule->setHours(implode(',', $array['hours']));
        $schedule->setMinutes(implode(',', $array['minutes']));
        $schedule->setLastDayOfMonth($array['lastDayOfMonth']);
        $schedule->setActive(true);

        return $schedule;
    }


}