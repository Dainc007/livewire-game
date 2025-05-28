<?php

declare(strict_types=1);

namespace App\Enums;

enum GameStatuses
{
    case RUNNING;
    case PAUSED;
    case STOPPED;
    case COMPLETED;
}
