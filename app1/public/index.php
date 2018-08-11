<?php

use App\AppKernel;
use Symfony\Component\HttpFoundation\Request;

require_once __DIR__.'/../vendor/autoload.php';

// Unsure that php-fpm use same timezone of postgresql.
date_default_timezone_set('UTC');

$app = new AppKernel();
$request = Request::createFromGlobals();
$response = $app->handle($request);
$response->send();
