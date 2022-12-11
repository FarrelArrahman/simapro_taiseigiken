<?php 

namespace App\Enums;

enum RoleEnum : string {
    case Admin = 'Admin';
    case ProjectHead = 'Project Head';
    case Worker = 'Worker';
    case Manager = 'Manager';

    public function color(): string
    {
        return match($this) 
        {
            RoleEnum::Admin => 'primary',
            RoleEnum::ProjectHead => 'warning',
            RoleEnum::Worker => 'success',
            RoleEnum::Manager => 'danger'
        };
    }
}

?>