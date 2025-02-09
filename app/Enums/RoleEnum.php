<?php

namespace App\Enums;

enum RoleEnum: string
{
    case AGRICULTOR = "agricultor";
    case ADMIN = "admin";
    case SUPERADMIN = "superadmin";
}
