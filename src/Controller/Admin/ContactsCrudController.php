<?php

namespace App\Controller\Admin;

use App\Entity\Contacts;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ContactsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contacts::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('last_name'),
            TextField::new('first_name'),
            TextField::new('code_name'),
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
        ];
    }
    
}
