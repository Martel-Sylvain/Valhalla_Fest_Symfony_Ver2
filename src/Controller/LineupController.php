<?php

namespace App\Controller;

use App\Entity\Groupes;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

class LineupController extends AbstractController
{
    #[Route('/lineup', name: 'app_lineup')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $groupes = $entityManager->getRepository(Groupes::class)->findBy([], ['nom_groupe' => 'ASC']);

        return $this->render('lineup/index.html.twig', [
            'groupes' => $groupes,
        ]);
    }
}
