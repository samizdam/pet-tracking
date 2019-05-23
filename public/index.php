<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Doctrine\ORM\EntityManager;
use Samizdam\PetTracking\Handler\CreateActivity;
use Samizdam\PetTracking\Handler\CreateTrack;
use Samizdam\PetTracking\Handler\GetDevice;
use Slim\App;

/**
 * @var EntityManager $entityManager
 */
$entityManager = require __DIR__ . '/../config/bootstrap.php';

$app = new App;
$app->post(
    '/api/v1/activity/',
    new CreateActivity($entityManager, new JsonMapper()));

$app->post(
    '/api/v1/tracks/',
    new CreateTrack($entityManager, new JsonMapper()));

$app->get(
    '/api/v1/devices/{deviceId}',
    new GetDevice($entityManager, new JsonMapper()));


$app->run();