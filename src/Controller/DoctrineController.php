<?php namespace verfriemelt\inserts\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use verfriemelt\inserts\Entity\DataPoint;

class DoctrineController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $em
    ) { }

    #[Route("/doctrine/persister")]
    public function doctrineModel(): JsonResponse
    {
        $point = new DataPoint(5);
        $this->em->persist($point);
        $this->em->flush();

        return new JsonResponse($point);
    }

    #[Route("/info")]
    public function doctrineConnection() {
        phpinfo();
        die();
    }

    #[Route("/doctrine/connection")]
    public function info(): JsonResponse
    {
        $point = new DataPoint(5);

        $result = $this
            ->em
            ->getConnection()
            ->executeQuery(
                <<<SQL
                    insert into data_point(value, created_at) 
                         values ( {$point->value}, '{$point->created->format('Y.m.d H:i:s')}') 
                      returning id
                SQL
            );

        $point->id = $result->fetchFirstColumn()[0];

        return new JsonResponse($point);
    }
}
