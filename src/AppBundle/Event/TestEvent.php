<?php

namespace AppBundle\Event;

use Symfony\Component\EventDispatcher\Event;

/**
 * @author mathil <github.com/mathil>
 */
class TestEvent extends Event
{

    private $who;

    private $what;

    private $when;

    public function __construct($who, $what)
    {
        $this->what = $what;
        $this->who = $who;
        $this->when = new \DateTime();
    }

    public function who()
    {
        return $this->who;
    }

    public function what()
    {
        return $this->what;
    }

    public function when()
    {
        return $this->when;
    }

}