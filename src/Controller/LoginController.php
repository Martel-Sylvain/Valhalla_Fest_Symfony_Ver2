<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {

        //on vérifie si il y a une erreur et on la stocke dans l'objet $error
        $error = $authenticationUtils->getLastAuthenticationError();

        //on récupère le lastUsername = adresse mail dans notre cas (on a defini que c'était le meil qui indentifiat un user)
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login/index.html.twig', [
            'error' => $error,
            'last_username' => $lastUsername
        ]);
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout()
    {

        $error = "";
        $lastUsername = "";
        return $this->render('home/index.html.twig', [
            'error' => $error,
            'last_username' => $lastUsername
        ]);
    }
}
