<?php

namespace Samizdam\PetTracking;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Device
 * @package Samizdam\PetTracking
 * @ORM\Entity()
 */
class Device
{

    /**
     * @ORM\Id()
     * @ORM\Column(type="string")
     *
     */
    private $id;
    /**
     * @ORM\OneToMany(targetEntity="Samizdam\PetTracking\Activity", mappedBy="deviceId")
     */
    private $activity;

    /**
     * @ORM\OneToMany(targetEntity="Samizdam\PetTracking\Track", mappedBy="device")
     * @ORM\OrderBy({"timestamp" = "ASC"})
     * @var ArrayCollection|Track[]
     */
    private $tracks;

    public function getLatestCoordinates(): Coordinates
    {
        $track = $this->tracks->last();
        return $track->getCoordinates();
    }

    public function setId(string $deviceId)
    {
        $this->id = $deviceId;
    }
}