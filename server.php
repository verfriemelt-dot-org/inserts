<?php

declare(strict_types=1);

use Swoole\Database\PDOConfig;
use Swoole\Database\PDOPool;
use Swoole\Http\Request as SwooleRequest;
use Swoole\Http\Response as SwooleResponse;
use Swoole\Http\Server as SwooleServer;
use verfriemelt\inserts\Entity\DataPoint;

include './src/Entity/DataPoint.php';

$pool = new PDOPool(
    (new PDOConfig())
        ->withDriver('pgsql')
        ->withHost('postgres')
        ->withPort(5432)
        ->withDbName('docker')
        ->withCharset('utf8mb4')
        ->withUsername('docker')
        ->withPassword('docker')
);

$swooleServer = new SwooleServer('0.0.0.0', 9501);

$swooleServer->set([
    'worker_num' => 12, // The number of worker processes to start
]);

$swooleServer->on('request', function (SwooleRequest $swooleRequest, SwooleResponse $swooleResponse) use ($pool) {
    $point = new DataPoint(5);

    $pdo = $pool->get();

    $result = $pdo->query(
        <<<SQL
            insert into data_point(value, created_at) 
            values ({$point->value}, '{$point->created->format('Y.m.d H:i:s')}') 
            returning id
        SQL
    );

    $point->id = $result->fetchColumn();

    $pool->put($pdo);

    $swooleResponse->header('Content-Type', 'application/json');
    $swooleResponse->end(json_encode($point));
});

$swooleServer->start();
