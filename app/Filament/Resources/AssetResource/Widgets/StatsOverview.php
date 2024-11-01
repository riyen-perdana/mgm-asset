<?php

namespace App\Filament\Resources\AssetResource\Widgets;

use App\Models\Asset;
use App\Models\Client;
use App\Models\Unit;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Jumlah Asset', Asset::count().' Asset')
                ->description('Total Asset')
                ->color('success'),
            Stat::make('Jumlah Relasi', Client::count().' Relasi')
                ->description('Total Relasi')
                ->color('success'),
            Stat::make('Jumlah Unit', Unit::count().' Unit')
                ->description('Total Unit')
                ->color('success'),
        ];
    }
}
