<?php

namespace App\Enums;

//enum usado para referenciar os estados possiveis da solicitação de amizade

enum FriendshipStatus: string
{
    case ACCEPTED = 'accepted';
    case PENDING  = 'pending';
    case DENIED   = 'denied';
}
