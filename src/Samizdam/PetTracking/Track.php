<?php

namespace Samizdam\PetTracking;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Class Track
 * @package Samizdam\PetTracking
 *
 * @ORM\Entity()
 * @ORM\Table(uniqueConstraints={@UniqueConstraint(columns={"deviceId", "timestamp"} )})
 */
class Track
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid")
     */
    private $eventId;
    /**
     * @ORM\ManyToOne(targetEntity="Samizdam\PetTracking\Device", inversedBy="tracks")
     * @ORM\JoinColumn(name="deviceId")
     */
    private $device;
    /**
     * int8 статус устройства
     * @ORM\Column(type="smallint")
     */
    private $deviceState;
    /**
     * int32 таймстамп в UTC
     * @ORM\Column(type="integer")
     */
    private $timestamp;
	/**
	 * floаt "lat" широта в градусах
	 *
	 * @ORM\Column(type="float")
	 */
	private $lat;
	/**
     * float "lon" долгота в градусах
     * @ORM\Column(type="float")
     */
	private $lon;
	/**
     * int8 высота в метрах
     * @ORM\Column(type="smallint")
     */
	private $height;
	/**
	 * int8 "accu" точность в метрах
	 * @ORM\Column(type="smallint")
	 */
	private $accuracy;

    public function setDevice(Device $device)
    {
        $this->device = $device;
    }

    public function setDeviceState(int $deviceState): void
    {
        $this->deviceState = $deviceState;
    }

    public function setTimestamp(int $timestamp): void
    {
        $this->timestamp = $timestamp;
    }

    public function setLat(float $lat): void
    {
        $this->lat = $lat;
    }

    public function setLon(float $lon): void
    {
        $this->lon = $lon;
    }

    public function setHeight(int $height): void
    {
        $this->height = $height;
    }

    public function setAccuracy(int $accuracy): void
    {
        $this->accuracy = $accuracy;
    }

    public function getCoordinates(): Coordinates
    {
        return new Coordinates($this->lat, $this->lon);
    }
}
