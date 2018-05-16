<?php

namespace AppBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\MappedSuperclass;

/**
 * @MappedSuperclass
 */
abstract class BaseEntity {


    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $ctime;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $mtime;

    public function getCtime() {
        return $this->ctime;
    }

    public function setCtime(\DateTime $ctime) {
        $this->ctime = $ctime;
    }

    public function getMtime() {
        return $this->mtime;
    }

    public function setMtime(\DateTime $mtime) {
        $this->mtime = $mtime;
    }

    /**
     * @ORM\PrePersist()
     */
    public function prePersist() {
        $this->ctime = new \DateTime();
        $this->mtime = new \DateTime();
    }

    /**
     * @ORM\PreUpdate()
     */
    public function preUpdate() {
        $this->mtime = new \DateTime();
    }




}