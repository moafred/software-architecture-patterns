<?php

use ControllerProvider\PokemonControllerProvider;
use ServiceProvider\ControllerServiceProvider;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app->error(function (\Exception $e, Request $request, $code) use ($app) {
    return new Response($e->getMessage() . PHP_EOL . $e->getTraceAsString(), $code);
});

/** @var Application $app */
$app->register(new ControllerServiceProvider());

// Pokemon
$app->mount('/', new PokemonControllerProvider());
