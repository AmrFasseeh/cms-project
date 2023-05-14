<?php

namespace App\Enums;

enum CustomAttributeType: int
{
    case TITLE = 1;
    case DATE = 2;
    case GRADE = 3;
    // date of birth
    case DOB = 4;
    case NAME = 5;
    // years of experience
    case YOE = 6;
    case AUTHOR = 7;
}
