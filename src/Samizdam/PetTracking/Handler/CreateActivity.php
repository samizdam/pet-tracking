<?php

namespace Samizdam\PetTracking\Handler;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use JsonMapper;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Samizdam\PetTracking\Activity;

class CreateActivity
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var JsonMapper
     */
    private $jsonMapper;

    public function __construct(EntityManagerInterface $entityManager, JsonMapper $jsonMapper)
    {
        $this->entityManager = $entityManager;
        $this->jsonMapper = $jsonMapper;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        if(!$request->hasHeader('Authorization')) {
            return $response->withStatus(401);
        }

        $jsonMapper = $this->jsonMapper;
        /** @var Activity $activity */
        $parsedBody = $request->getParsedBody();
        $activity = $jsonMapper->map((object)$parsedBody, new Activity());
        $activity->setDeviceId($request->getHeader('Authorization')[0]);
        if($this->entityManager->getRepository(Activity::class)->findOneBy([
            'timestamp' => $activity->getTimestamp(),
            'deviceId' => $activity->getDeviceId(),
        ])) {
            return $response->withStatus(409);
        }
        $this->entityManager->persist($activity);
        $this->entityManager->flush();

        return $response->withStatus(201);

    }
}