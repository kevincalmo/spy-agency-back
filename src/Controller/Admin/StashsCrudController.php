<?php

namespace App\Controller\Admin;

use App\Entity\Stashs;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class StashsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Stashs::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            IntegerField::new('code'),
            TextField::new('adress'),
            ChoiceField::new('country')->setChoices([
                'Royaume-Uni'=>'united-kingdom',
                'France'=> 'french',
                'Espagne'=>'spanish',
                'Etat-Unis'=>'united-states',
                'Russie'=>'russia',
                'Libië'=>'libia',
                'Australie'=>'australia',
            ]),
            ChoiceField::new('type')->setChoices([
                'maison'=>'home',
                'bumker'=>'bumker',
            ]),
        ];
    }
    
}
