<?php

namespace Samizdam\PetTracking\Handler;

use Doctrine\ORM\EntityManagerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Samizdam\PetTracking\Device;

class GetDevice
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
        $deviceId = $args['deviceId'];
        $device = $this->entityManager->find(Device::class, $deviceId);
//
        $response->getBody()->write(json_encode([
            'latest' => $device->getLatestCoordinates(),
        ]));

        return $response;
    }
}