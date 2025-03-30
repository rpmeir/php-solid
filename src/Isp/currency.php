<?php

declare(strict_types=1);

use Slim\Factory\AppFactory;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

require_once __DIR__ . '/../../vendor/autoload.php';

$app = AppFactory::create();

$app->get('/currency', function (Request $request, Response $response) {
    if($request)
    {
        $response->getBody()->write(json_encode(['value' => 6]));
        return $response->withHeader('Content-Type', 'application/json');
    }
});

$app->run();
