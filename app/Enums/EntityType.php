<?php

namespace App\Enums;

enum EntityType: int
{
    case COURSE = 1;
    case BOOK = 2;
    case STUDENT = 3;
    case INSTRUCTOR = 4;
    case OTHER = 5;
}
