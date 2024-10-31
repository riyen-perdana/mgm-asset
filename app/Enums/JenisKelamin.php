<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum JenisKelamin:string implements HasLabel
{
    case L = 'L';
    case P = 'P';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::L => 'Laki-Laki',
            self::P => 'Perempuan',
        };
    }
}
