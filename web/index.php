<?php

use Symfony\Component\HttpFoundation\Request;

require '../vendor/autoload.php';
require '../app/MyApp.php';

$request = Request::createFromGlobals();

$app      = new MyApp('prod');
$response = $app->handle($request);
$response->send();