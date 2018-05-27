<?php

namespace AppBundle\Entity;

use AppBundle\Model\PushMessage;
use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\OneToOne(targetEntity="Schedule", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="schedule_id", referencedColumnName="id")
     */
    private $schedule;


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
     * Set schedule.
     *
     * @param string $schedule
     *
     * @return PushNotificationSchedule
     */
    public function setSchedule($schedule)
    {
        $this->schedule = $schedule;

        return $this;
    }

    /**
     * Get schedule.
     *
     * @return string
     */
    public function getSchedule()
    {
        return $this->schedule;
    }

}
