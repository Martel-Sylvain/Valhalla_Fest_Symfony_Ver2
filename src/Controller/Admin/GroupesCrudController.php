<?php

namespace App\Controller\Admin;

use App\Entity\Groupes;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class GroupesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Groupes::class;
    }

    public function configureFields(string $pageName): iterable
    {
        //on crée un tableau fields qui correspond à tous les champs que l'on souhaite voir dans le dashboard pour la table groupes
        $fields = [
            ImageField::new('photo', 'Photo du groupe') //prend 'photo' (cf Entity Groupes) en propriété et s'appelle 'Photo du groupe'
                ->setBasePath('uploads/') //dossier dans lequel ca va
                ->setUploadDir('public/uploads') //chemin dans lequel ca va
                ->setUploadedFileNamePattern('[randomhash].[extension]') //pour renommer le fichier image au cas où l'on ait 2 fichier du même nom, cela rend chaque fichier unique, et on ajoute l'extension du fichier.
                ->setRequired(false) //on met false car il y a un bug si on vient faire une modif dans le dashboard, si l'image est a déjà été chargée, il faut la charger à nouveau à chaque save
        ];

        $logo =
            //même chose pour le logo
            ImageField::new('logo', 'Logo')
            ->setBasePath('uploads')
            ->setUploadDir('public/uploads')
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            ->setRequired(false); //on met false car il y a un bug si on vient faire une modif dans le dashboard, si l'image est adéjà été chargée, il faut la charger à nouveau à chaque save

        //on en a pas besoin ici
        //$slug = SlugField::new('slug')->setTargetFieldName('name');

        $nom =
            //Pour le nom on utilise TextField et on ajoute dans un tableau la longueur max que l'on avait choisi 255
            TextField::new('nom_groupe', 'Groupe')
            ->setFormTypeOptions([
                'attr' => [
                    'maxlength' => 255
                ]
            ]);

        $description =
            //ici c'est une zone de texte libre sans restriction de taille, cela donner une champ particulier de saisie de texte dans une boite de dialogue avec possibilité de mettre en gras par exemple
            TextEditorField::new('description', 'Description');

        //on ajoute ensuite toutes ces variaables dans le tableau $fields
        $fields[] = $logo;
        $fields[] = $nom;
        $fields[] = $description;

        return $fields;
    }
}
