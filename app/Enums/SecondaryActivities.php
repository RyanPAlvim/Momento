<?php

namespace App\Enums;

// enum para referenciar tipos de atividades secundárias que o usuário poderá fazer

enum SecondaryActivities: string
{
    case READING = 'reading';
    case GYM = 'gym';
    case YOGA = 'yoga';
    case RUNNING = 'running';
}
