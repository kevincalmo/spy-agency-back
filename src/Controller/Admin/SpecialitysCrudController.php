<?php

namespace App\Controller\Admin;

use App\Entity\Specialitys;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SpecialitysCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Specialitys::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            
        ];
    }
    
}
