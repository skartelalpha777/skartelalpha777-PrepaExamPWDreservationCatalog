<?php

namespace App\Enum;

enum Roles: string
{

    case Producteur = 'ROLE_PRODUCTEUR';
    case Administrateur = 'ROLE_ADMIN';
    case Membre = 'ROLE_MEMBRE';

    /*
     * @return Le roles mais avec une Majuscule lors de l'affichage 
     */
    public function getLabel(): string
    {
        return match ($this) {
            self::Producteur => 'ROLE_PRODUCTEUR',
            self::Administrateur => 'ROLE_ADMIN',
            self::Membre => 'ROLE_MEMBRE'
        };
    } 
}
