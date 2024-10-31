<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum JenisRelasi:string implements HasLabel
{
    case Mahasiswa = 'mahasiswa';
    case Tendik  = 'tendik';
    case Dosen = 'dosen';
    case Umum = 'umum';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Mahasiswa => 'Mahasiswa',
            self::Tendik => 'Tenaga Kependidikan',
            self::Dosen => 'Dosen',
            self::Umum => 'Umum',
        };
    }

    public function getColor(): ?string
    {
        return match ($this) {
            self::Mahasiswa => 'primary',
            self::Tendik => 'success',
            self::Dosen => 'danger',
            self::Umum => 'warning'
        };
    }


}
