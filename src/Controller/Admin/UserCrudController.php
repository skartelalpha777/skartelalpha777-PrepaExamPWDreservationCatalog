<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Enum\Roles;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;


class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('firstname'),
            TextField::new('lastname'),
            TextField::new('email')->hideOnForm(),          
            ChoiceField::new('role')
                ->setChoices([
                    'Admin' => Roles::Administrateur,
                    'Producteur' => Roles::Producteur,
                    'Membre' => Roles::Membre,
                ])
            // TextEditorField::new('description'),
        ];
    }
}
