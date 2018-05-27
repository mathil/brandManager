<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Schedule
 *
 * @ORM\Table(name="schedule")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ScheduleRepository")
 */
class Schedule
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateFrom", type="datetime")
     */
    private $dateFrom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateTo", type="datetime")
     */
    private $dateTo;

    /**
     * @var string
     *
     * @ORM\Column(name="hours", type="string", length=255)
     */
    private $hours;

    /**
     * @var string
     *
     * @ORM\Column(name="minutes", type="string", length=255)
     */
    private $minutes;

    /**
     * @var string
     *
     * @ORM\Column(name="daysOfWeek", type="string", length=255)
     */
    private $daysOfWeek;

    /**
     * @var string
     *
     * @ORM\Column(name="daysOfMonth", type="string", length=255)
     */
    private $daysOfMonth;

    /**
     * @var string
     *
     * @ORM\Column(name="lastDayOfMonth", type="string", length=255)
     */
    private $lastDayOfMonth;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;


    public function __toString()
    {
        return '';
    }

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
     * Set dateFrom.
     *
     * @param \DateTime $dateFrom
     *
     * @return Schedule
     */
    public function setDateFrom($dateFrom)
    {
        $this->dateFrom = $dateFrom;

        return $this;
    }

    /**
     * Get dateFrom.
     *
     * @return \DateTime
     */
    public function getDateFrom()
    {
        return $this->dateFrom;
    }

    /**
     * Set dateTo.
     *
     * @param \DateTime $dateTo
     *
     * @return Schedule
     */
    public function setDateTo($dateTo)
    {
        $this->dateTo = $dateTo;

        return $this;
    }

    /**
     * Get dateTo.
     *
     * @return \DateTime
     */
    public function getDateTo()
    {
        return $this->dateTo;
    }

    /**
     * Set hours.
     *
     * @param string $hours
     *
     * @return Schedule
     */
    public function setHours($hours)
    {
        $this->hours = $hours;

        return $this;
    }

    /**
     * Get hours.
     *
     * @return string
     */
    public function getHours()
    {
        return $this->hours;
    }

    /**
     * Set minutes.
     *
     * @param string $minutes
     *
     * @return Schedule
     */
    public function setMinutes($minutes)
    {
        $this->minutes = $minutes;

        return $this;
    }

    /**
     * Get minutes.
     *
     * @return string
     */
    public function getMinutes()
    {
        return $this->minutes;
    }

    /**
     * Set daysOfWeek.
     *
     * @param string $daysOfWeek
     *
     * @return Schedule
     */
    public function setDaysOfWeek($daysOfWeek)
    {
        $this->daysOfWeek = $daysOfWeek;

        return $this;
    }

    /**
     * Get daysOfWeek.
     *
     * @return string
     */
    public function getDaysOfWeek()
    {
        return $this->daysOfWeek;
    }

    /**
     * Set daysOfMonth.
     *
     * @param string $daysOfMonth
     *
     * @return Schedule
     */
    public function setDaysOfMonth($daysOfMonth)
    {
        $this->daysOfMonth = $daysOfMonth;

        return $this;
    }

    /**
     * Get daysOfMonth.
     *
     * @return string
     */
    public function getDaysOfMonth()
    {
        return $this->daysOfMonth;
    }

    /**
     * Set lastDayOfMonth.
     *
     * @param string $lastDayOfMonth
     *
     * @return Schedule
     */
    public function setLastDayOfMonth($lastDayOfMonth)
    {
        $this->lastDayOfMonth = $lastDayOfMonth;

        return $this;
    }

    /**
     * Get lastDayOfMonth.
     *
     * @return string
     */
    public function getLastDayOfMonth()
    {
        return $this->lastDayOfMonth;
    }

    /**
     * Set active.
     *
     * @param bool $active
     *
     * @return Schedule
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active.
     *
     * @return bool
     */
    public function getActive()
    {
        return $this->active;
    }
}
