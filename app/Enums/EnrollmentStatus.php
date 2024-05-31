<?php

namespace App\Enums;

enum EnrollmentStatus: string
{
    case Actived = 'actived';
    case Completed = 'completed';
    case Canceled = 'canceled';
}
