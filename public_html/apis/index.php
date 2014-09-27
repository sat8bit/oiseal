<?php

use Oiseal\Seal;
use Oiseal\Exception;

$app = require __DIR__ . "/../../src/bootstrap.php";

$app->group('/v1', function () use ($app) {

    $app->get('/seals', function () use ($app) {
        $accessToken = $app->request->get('access_token');
        $user = $app->userRepository->findByAccessToken($accessToken);

        if (empty($user)) {
            throw new Exception\ForbiddenException('request forbidden.');
        }

        $sealSet = $app->sealRepository->findByUser($user);

        $app->response->setBody(json_encode($sealSet->toArray()));
    });

    $app->post('/seals', function () use ($app) {
        $request = json_decode($app->request->getBody());

        if (empty($request)) {
            throw new Exception\BadRequestException('request body is not json.');
        }

        $accessToken = $request->access_token;
        $user = $app->userRepository->findByAccessToken($accessToken);

        if (empty($user)) {
            throw new Exception\ForbiddenException('request forbidden.');
        }

        $placeId = $request->place_id;
        $place = $app->placeRepository->find($placeId);

        if (empty($place)) {
            throw new Exception\BadRequestException("request place is not found. place_id:$placeId");
        }

        $app->sealRepository->store(new Seal\Seal($user, $place));
        $app->response->setStatus(201);
    });
});

$app->run();
