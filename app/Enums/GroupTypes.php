<?php

namespace App\Enums;

//enum para referenciar tipos possíveis de um grupo

enum GroupTypes: string
{
    case COMPETITION = 'competition';
    case COLABORATIVE = 'colaborative';
}
