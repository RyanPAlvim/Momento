<?php

namespace App\Enums;



enum FriendshipStatus: string
{
    case ACCEPTED = 'accepted';
    case PENDING  = 'pending';
    case DENIED   = 'denied';
}
