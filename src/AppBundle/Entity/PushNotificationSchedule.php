<?php

namespace AppBundle\Entity;

use AppBundle\Model\PushMessage;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;

/**
 * PushNotificationSchedule
 *
 * @ORM\Table(name="push_notification_schedule")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PushNotificationScheduleRepository")
 */
class PushNotificationSchedule extends PushMessage
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="hour", type="smallint")
     */
    private $hour;

    /**
     * @var int
     *
     * @ORM\Column(name="minute", type="smallint")
     */
    private $minute;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="dateFrom", type="datetime", nullable=true)
     */
    private $dateFrom;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="dateTo", type="datetime", nullable=true)
     */
    private $dateTo;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return PushNotificationSchedule
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set hour.
     *
     * @param int $hour
     *
     * @return PushNotificationSchedule
     */
    public function setHour($hour)
    {
        $this->hour = $hour;

        return $this;
    }

    /**
     * Get hour.
     *
     * @return int
     */
    public function getHour()
    {
        return $this->hour;
    }

    /**
     * Set minute.
     *
     * @param int $minute
     *
     * @return PushNotificationSchedule
     */
    public function setMinute($minute)
    {
        $this->minute = $minute;

        return $this;
    }

    /**
     * Get minute.
     *
     * @return int
     */
    public function getMinute()
    {
        return $this->minute;
    }

    /**
     * Set dateFrom.
     *
     * @param DateTime|string $dateFrom
     *
     * @return PushNotificationSchedule
     */
    public function setDateFrom($dateFrom)
    {
        if (is_string($dateFrom)) {
            $this->dateFrom = new DateTime($dateFrom . ' 00:00:00');
        } else {
            $this->dateFrom = $dateFrom;
        }

        return $this;
    }

    /**
     * Get dateFrom.
     *
     * @return DateTime
     */
    public function getDateFrom()
    {
        return $this->dateFrom;
    }

    /**
     * Set dateTo.
     *
     * @param DateTime $dateTo
     *
     * @return PushNotificationSchedule
     */
    public function setDateTo($dateTo)
    {
        if (is_string($dateTo)) {
            $this->dateTo = new DateTime($dateTo . ' 00:00:00');
        } else {
            $this->dateTo = $dateTo;
        }
        
        return $this;
    }

    /**
     * Get dateTo.
     *
     * @return DateTime
     */
    public function getDateTo()
    {
        return $this->dateTo;
    }
}
