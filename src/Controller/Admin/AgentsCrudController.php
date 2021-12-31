<?php

namespace App\Controller\Admin;

use App\Entity\Agents;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AgentsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Agents::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('last_name'),
            TextField::new('first_name'),
            TextField::new('code_auth'),
            DateField::new('birth_date'),
            ChoiceField::new('country')->setChoices([
                'Royaume-Uni'=>'united-kingdom',
                'France'=> 'french',
                'Espagne'=>'spanish',
                'Etat-Unis'=>'united-states',
                'Russie'=>'russia',
                'Libië'=>'libia',
                'Australie'=>'australia',
            ]),
            AssociationField::new('specialitys'),
        ];
    }
   
}
