<?php

include '../src/Entity/DataPoint.php';

use verfriemelt\inserts\Entity\DataPoint;

$point = new DataPoint(5);

$pdo = new \PDO(
    "pgsql:host={$_ENV['POSTGRES_HOST']};port=5432;dbname=docker",
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

echo json_encode($point);
