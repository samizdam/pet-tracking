<?php

namespace Samizdam\PetTracking;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Class Activity
 * @package Samizdam\PetTracking
 * @ORM\Entity
 * @ORM\Table(uniqueConstraints={@UniqueConstraint(columns={"deviceId", "timestamp"} )})
 */
class Activity
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid")
     */
    private $eventId;
    /**
     * @ORM\Column(type="string")
     */
    private $deviceId;
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
     * int8 тип активности (0 - сон,1 - шаг,3 - галоп,6 - рысь,255 - шаги не измеряются)
     */
	private const ACTIVITY_TYPE_SLEEP = 0;
	private const ACTIVITY_TYPE_STEP = 1;
	private const ACTIVITY_TYPE_GALLOP = 3;
	private const ACTIVITY_TYPE_TROT = 6;
	private CONST ACTIVITY_TYPE_UNMEASURED = 255;

    /**
     * @ORM\Column(type="smallint")
     */
	private $activityType;

	/**
     * int кол-во шагов
     * @ORM\Column(type="integer")
     */
	private $numberOfSteps;

    public function setDeviceState(int $deviceState)
    {
        $this->deviceState = $deviceState;
    }

    public function setTimestamp(int $timestamp)
    {
        $this->timestamp = $timestamp;
    }

    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    public function setActivityType(int $activityType)
    {
        $this->activityType = $activityType;
    }

    public function setNumberOfSteps(int $numberOfSteps)
    {
        $this->numberOfSteps = $numberOfSteps;
    }

    public function setDeviceId(string $deviceId)
    {
        $this->deviceId = $deviceId;
    }

    public function getDeviceId(): string
    {
        return $this->deviceId;
    }
}
