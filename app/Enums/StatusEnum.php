<?php 

namespace App\Enums;

enum StatusEnum : string {
    case Approved = 'Approved';
    case Pending = 'Pending';
    case Rejected = 'Rejected';
    case Active = 'Active';
    case Inactive = 'Inactive';
    case Done = 'Done';
    case Incomplete = 'Incomplete';

    public function color(): string
    {
        return match($this) 
        {
            StatusEnum::Approved => 'primary',
            StatusEnum::Pending => 'warning',
            StatusEnum::Rejected => 'danger',
            StatusEnum::Active => 'success',
            StatusEnum::Inactive => 'secondary',
            StatusEnum::Done => 'info',
            StatusEnum::Incomplete => 'dark'
        };
    }

    public function icon(): string
    {
        return match($this) 
        {
            StatusEnum::Approved => 'fas fa-check',
            StatusEnum::Pending => 'far fa-clock',
            StatusEnum::Rejected => 'far fa-x',
        };
    }

    public static function activeCases(): array
    {
        return [
            StatusEnum::Active,
            StatusEnum::Inactive,
        ];
    }

    public static function approvalCases(): array
    {
        return [
            StatusEnum::Approved,
            StatusEnum::Pending,
            StatusEnum::Rejected,
        ];
    }

    public static function completionCases(): array
    {
        return [
            StatusEnum::Done,
            StatusEnum::Incomplete,
        ];
    }
}

?>