<?php

namespace App\Enums;

//enum utilizado para referenciar os estados possíveis da relação de um usuário com um grupo

enum GroupStatus: string
{
    case MEMBER = 'member';
    case ADMIN = 'admin';
    case PENDING = 'pending';
    case DENIED = 'denied';
}
