<?php

require_once __DIR__ . '/vendor/autoload.php';

use Adapterman\Adapterman;
use Workerman\Worker;

Adapterman::init();

$http_worker                = new Worker('http://0.0.0.0:8080');
$http_worker->count         = 8;
$http_worker->name          = 'AdapterMan';

$http_worker->onWorkerStart = static function () {
    //init();
    require __DIR__.'/start.php';
};

$http_worker->onMessage = static function ($connection, $request) {

    $connection->send(run());
};

Worker::runAll();
