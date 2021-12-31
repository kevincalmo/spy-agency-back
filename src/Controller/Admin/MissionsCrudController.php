<?php

namespace App\Controller\Admin;

use App\Entity\Missions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\TextEditorType;

class MissionsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Missions::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title'),
            TextField::new('code_name'),
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
                'assassinat'=>'assassinat',
            ]),
            DateTimeField::new('start_date'),
            DateTimeField::new('end_date'),
            AssociationField::new('specialitys'),
            AssociationField::new('agents'),
            AssociationField::new('contacts'),
            AssociationField::new('targets'),
            AssociationField::new('stashs'),
            TextEditorField::new('content')->hideOnIndex(),
        ];
    }
    
}
