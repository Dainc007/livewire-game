<?php

namespace App\Enums;

enum GameStatuses
{
    case RUNNING;
    case PAUSED;
    case STOPPED;
    case COMPLETED;
}
