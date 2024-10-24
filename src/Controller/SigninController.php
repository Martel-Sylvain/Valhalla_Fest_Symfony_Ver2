<?php

namespace App\Controller;

use App\Entity\Utilisateurs;
use App\Form\SigninType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class SigninController extends AbstractController
{
    #[Route('/signin', name: 'app_signin')]
    //on peut injecter dans la fonction la requête
    public function index(Request $req, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {

        //on va avoir besoin de créer un objet utilisateur qui sera utilisé ensuite pour persister les données dans la BDD
        $utilisateur = new Utilisateurs();

        //on va créer le formulaire. createForm est une fonction de Symfony qui prend en paramètres SigninType pour pouvoir créer le formulaire associé, et le $utilisateur que l'on vient de créer
        $form = $this->createForm(SigninType::class, $utilisateur);

        //gère le fait que le formulaire a été soumis
        $form->handleRequest($req);

        //on fait un if pour vérifier si le formulaire a bien été soumis et si son contenu est valide
        if ($form->isSubmitted() && $form->isValid()) {
            //le formulaire a été conçu pour un utilisateur, donc les données du formulaire correspondent à un utilisateur
            $utilisateur = $form->getData();

            //hasher le mot de passe
            //on récupère le mot de passe
            $plaintextPassword = $utilisateur->getPassword();
            //on hash le mot de passe
            $hashedPassword = $passwordHasher->hashPassword(
                $utilisateur,
                $plaintextPassword
            );
            //on change ajoute le mot de passe hashé dans $utilisateur
            $utilisateur->setPassword($hashedPassword);

            // Persister l'utilisateur en base de données
            $entityManager->persist($utilisateur);
            $entityManager->flush();
            //Afficher un message pour dire que l'inscription c'est bien passée

        } else {
            //Afficher une erreur, faire une page d'erreur et un return $this->render(/page d'erreur)
        }

        return $this->render('signin/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
