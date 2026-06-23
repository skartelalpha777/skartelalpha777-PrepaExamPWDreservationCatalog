<?php

namespace App\Controller\Admin;

use App\Entity\Representation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RepresentationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Representation::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            DateTimeField::new('schedule'),
            AssociationField::new('representationShow'),
            AssociationField::new('location'),
           
        ];
    }
    
}
