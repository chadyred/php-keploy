<?php

namespace App\Controller;

use App\Entity\Employee;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EmployeeController extends AbstractController
{
    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    #[Route('/employee', name: 'app_employee', methods: ['POST'])]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $e = new Employee();

        $e->setEmail('test2@test.com');
        $e->setFirstName('tetssdf');
        $e->setLastName('test222');
        $entityManager->persist($e);
        $entityManager->flush();

        return $this->json($e);
    }
}
