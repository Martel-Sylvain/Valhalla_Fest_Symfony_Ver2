<?php

namespace App\Controller\Admin;

use App\Entity\Groupes; //on ajoute l'entité groupes car on va en avoir besoin plus bas
use App\Entity\Utilisateurs;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator; //va permettre de générer des url dans l'administration afin de pouvoir personnaliser

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        //return parent::index();page de base de EasyAdmin

        //on récupère le adminUrlGenerator qui va permettre de récupérer une url
        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        //on crée une variable qui récupère cette url en définissant le controller pour lequel on veut créer l'url => va créer l'url pour pouvoir accéder à GroupesCrudController
        $url = $routeBuilder->setController(GroupesCrudController::class)->generateUrl();
        //on redirige ensuite vers cette url
        return $this->redirect($url); //si on va sur la page admin, on sera directement sur notre administration et on verra la table groupes

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    //fonction qui permettra de configurer le dashboard
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Administration Valhalla Fest');
        //on pourra ajouter par exemple une icone
    }


    //permet de créer le menu latéral
    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-user', Utilisateurs::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        yield MenuItem::linkToCrud('Groupes', 'fas fa-list', Groupes::class);
    }
}
