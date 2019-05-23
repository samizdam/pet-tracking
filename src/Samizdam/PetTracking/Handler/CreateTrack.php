<?php

namespace Samizdam\PetTracking\Handler;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Samizdam\PetTracking\Device;
use Samizdam\PetTracking\Track;

class CreateTrack
{


    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var \JsonMapper
     */
    private $jsonMapper;

    public function __construct(EntityManagerInterface $entityManager, \JsonMapper $jsonMapper)
    {
        $this->entityManager = $entityManager;
        $this->jsonMapper = $jsonMapper;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        if(!$request->hasHeader('Authorization')) {
            return $response->withStatus(401);
        }

        $deviceId = $request->getHeader('Authorization')[0];
        if ($device = $this->entityManager->find(Device::class, $deviceId) ) {

        } else {
            $device = new Device();
            $device->setId($deviceId);
            $this->entityManager->persist($device);
        }
        /**@var Track $track */
        $track = $this->jsonMapper->map((object)$request->getParsedBody(), new Track());
        $track->setDevice($device);
        $this->entityManager->persist($track);

        $this->entityManager->flush();

        return $response->withStatus(201);
    }
}