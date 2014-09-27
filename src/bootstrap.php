<?php

require __DIR__ . "/../vendor/autoload.php";

// init
$app = new Slim\Slim(array(
    'debug' => false
));

$app->notFound(function () use ($app) {
    error_log('no route.');
    $app->response->setStatus(404);
});

$app->error(function (Exception $e) use ($app) {
    if ($e instanceof Oiseal\Exception\HttpException) {
        $app->response->setStatus($e->getStatus());
    }
        $app->response->setStatus(500);
});

// di
$app->facebookRequestFactory = function ($c) {
    $facebookApp = new Facebook\Entities\FacebookApp(
        $c['config']['facebook-appid'],
        $c['config']['facebook-secret']);
    return new Oiseal\Facebook\FacebookRequestFactory($facebookApp);
};

$app->userRepository = function ($c) {
    return new Oiseal\User\UserRepository(new \Facebook\FacebookClient(), $c['facebookRequestFactory']);
};

$app->yolpApi = function ($c) {
    $appid = $c['config']['yjdn-appid'];
    $guzzle = new GuzzleHttp\Client(['base_url' => 'http://search.olp.yahooapis.jp']);
    return new Oiseal\Infra\YolpApi($guzzle, $appid);
};

$app->placeRepository = function ($c) {
    return new Oiseal\Place\PlaceRepository($c['yolpApi']);
};

$app->pdo = function ($c) {
    $user = $c['config']['user'];
    $password = $c['config']['password'];
    $pdo = new PDO('mysql:dbname=oiseal;host=localhost;charset=utf8', $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
};

$app->sealRepository = function ($c) {
    return new Oiseal\Seal\SealRepository($c['pdo']);
};

$app->config = function ($c) {
    return parse_ini_file(__DIR__."/../conf/oiseal.ini");
};

// return
return $app;
