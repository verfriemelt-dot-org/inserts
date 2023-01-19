<?php namespace verfriemelt\inserts\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use verfriemelt\inserts\Entity\DataPoint;

class PdoController extends AbstractController
{
    #[Route("/pdo/connection")]
    public function doctrineConnection(): JsonResponse
    {
        $point = new DataPoint(5);

        $pdo = new \PDO(
            "pgsql:host={$_ENV['POSTGRES_HOST']};port={$_ENV['POSTGRES_PORT']};dbname={$_ENV['POSTGRES_DB']}",
            $_ENV['POSTGRES_USER'],
            $_ENV['POSTGRES_PASSWORD'],
        );

        $result = $pdo->query(            <<<SQL
                    insert into data_point(value, created_at) 
                         values ( {$point->value}, '{$point->created->format('Y.m.d H:i:s')}') 
                      returning id
                SQL
        );

        $point->id = $result->fetchColumn();

        return new JsonResponse($point);
    }


}
