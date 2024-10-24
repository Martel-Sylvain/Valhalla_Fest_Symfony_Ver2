<?php

namespace App\Controller;

use App\Entity\Groupes;
use App\Repository\GroupesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class GroupesController extends AbstractController
{
    #[Route('/groupes', name: 'app_groupes')]
    public function index(): Response
    {
        return $this->render('groupes/index.html.twig', [
            'controller_name' => 'GroupesController',
        ]);
    }


    //ENVOYER DES DONNEES DANS LA BASE EN UTILISANT ENTITY MANAGER
    //route qui permet de faire des tests, manuels pour l'envoi de nouveaux groupes dans la BDD
    //on va injecter en paramètre l'EntityManagerInterface qui va nous permettre de créer un groupe et de le persister dans la BDD
    //penser à ajouter le use Doctrine\ORM\EntityManagerInterface;
    //et aussi le use App\Entity\Groupes; on aura ainsi accès à toutes les fonctions de Groupes
    // #[Route('/add-groupe', name: 'create_groupe')]
    // public function createGroupe(EntityManagerInterface $entityManager): Response
    // {
    //     //ici pour créer un nouveau groupe, on va définir les différents champs à partir des setters de l'entity Groupes, et les valeurs que l'on passe sont des valeurs ici qui seront fixes, tous les éléments (colonnes de la table) sont obligatoires
    //     $groupe = new Groupes();
    //     $groupe->setNomGroupe('Groupe1');
    //     $groupe->setLogo('chemin du logo');
    //     $groupe->setPhoto('chemin de la photo');
    //     $groupe->setDescription('description du groupe');

    //     // va permettre de dire à Doctrine que l'on veut sauvegarder ce $product dans la base de données
    //     $entityManager->persist($groupe);

    //     // permet d'exécuter la requête SQL
    //     $entityManager->flush();

    //     //ici on va afficher un message de confirmation
    //     return new Response('Saved new product with id ' . $groupe->getId());

    //     //aller ensuite sur la page /add-groupe pour voir le message
    //     //aller voir dans la base, et on verra que le groupe a été inséré
    // }




    //RECUPERER DES DONNEES DE LA BASE EN UTILISANT ENTITY MANAGER
    //autre version de la route /groupes pour afficher des données en provenance de la BDD en utilisant l'identifiant=>on l'ajoute en paramètre de la fonction : int $id
    //on ajoute /{id} au chemin de la route pour que la route devienne dynamique avec l'id
    //si on fait /groupes/1 on sera sur l'id = 1 de la table groupes

    // #[Route('/groupes/{id}', name: 'app_groupes')]
    // public function index(EntityManagerInterface $entityManager, int $id): Response
    // {
    //     //ici on fait une requête pour récupérer un groupe via son id
    //     //on récupère un accès à la classe Groupes : getRepository(Groupes::class)
    //     //on utilise la fonction find($id) pour aller chercher l'id
    //     //si l'id existe on va stocker le résultat dans la variable $groupe
    //     $groupe = $entityManager->getRepository(Groupes::class)->find($id);

    //     // si l'id n'existe pas : 
    //     if (!$groupe) {
    //         throw $this->createNotFoundException(
    //             'Pas de groupe trouvé pour l\'id ' . $id
    //         );
    //     }

    //     //si l'id a été trouvé, on va ici récupérer le nom du groupe et l'envoyer à la vue
    //     return $this->render('groupes/index.html.twig', [

    //         'nom' => $groupe->getNomGroupe()
    //     ]);
    // }

    //on récupère la variable 'nom' pour la mettre dans le index.html.twig de Groupes
    //pour voir le résultat aller sur /groupes/1
    //on verra le nom du groupe apparaitre celui qui a l'id 1
    //si on va sur /groupes/10000
    //pas de groupe créé avec cet id, donc on aura un message d'erreur





    //RECUPERER DES DONNEES DE LA BASE EN UTILISANT LE REPOSITORY
    //Aller voir la fonction findOneById dans le GroupesRepository
    //ajouter le use App\Repository\GroupesRepository;

    // #[Route('/groupes/{id}', name: 'app_groupes')]
    // public function index(GroupesRepository $groupesRepository, int $id): Response
    // {
    //     //on récupère le groupe en passant par le groupesRepository et on utilise la fonction findOneById en lui passant $id
    //     $groupe = $groupesRepository->findOneById($id);

    //     // si l'id n'existe pas : 
    //     if (!$groupe) {
    //         throw $this->createNotFoundException(
    //             'Pas de groupe trouvé pour l\'id ' . $id
    //         );
    //     }

    //     //si l'id a été trouvé, on va ici récupérer le nom du groupe et l'envoyer à la vue
    //     return $this->render('groupes/index.html.twig', [

    //         'nom' => $groupe->getNomGroupe()
    //     ]);
    // }

    //on obtient le même résultat qu'avec la route précédente
}
