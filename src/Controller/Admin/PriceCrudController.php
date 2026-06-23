<?php

namespace App\Controller\Admin;

use App\Entity\Price;
use App\Enum\TicketType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PriceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Price::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('price'),
            ChoiceField::new('type')
                ->setChoices([
                    'Standart' => TicketType::Standard,
                    'Senior' => TicketType::Senior,
                    'Enfant' => TicketType::Enfant,

                ]),
            DateTimeField::new('start_date'),
            DateTimeField::new('end_date'),
        ];
    }
}
