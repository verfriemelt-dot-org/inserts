<?php
include '../src/Entity/DataPoint.php';

use verfriemelt\inserts\Entity\DataPoint;

$http = new Swoole\Http\Server('127.0.0.1', 9501);

$http->on('start', function ($server) {
    echo "Swoole http server is started at http://127.0.0.1:9501\n";
});

$http->set([
    'worker_num' => 100,      // The number of worker processes to start
]);

$http->on('request', function ($request, $response) {
    $response->header('Content-Type', 'text/plain');

    $point = new DataPoint(5);

    $pdo = new \PDO(
        "pgsql:host=localhost;port=5432;dbname=docker",
        "docker",
        "docker",
    );

    $result = $pdo->query(            <<<SQL
                    insert into data_point(value, created_at) 
                         values ( {$point->value}, '{$point->created->format('Y.m.d H:i:s')}') 
                      returning id
                SQL
    );

    $point->id = $result->fetchColumn();
    $response->end(json_encode($point));
});

$http->start();
