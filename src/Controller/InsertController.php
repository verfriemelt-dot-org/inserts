<?php namespace verfriemelt\inserts\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use verfriemelt\inserts\Entity\DataPoint;

class InsertController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $em
    ) { }

    #[Route("/")]
    public function index(): JsonResponse
    {

        $this->em->getConnection()->executeQuery('insert into docker.data_point (value) values (5)');

        return new JsonResponse($point);
    }
}
