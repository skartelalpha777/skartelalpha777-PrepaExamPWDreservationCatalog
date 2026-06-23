<?php

namespace App\Enum;

enum Status: string
{

    case Accepted = 'accepted';
    case Pending = 'pending';
    case Refused = 'refused';
}
