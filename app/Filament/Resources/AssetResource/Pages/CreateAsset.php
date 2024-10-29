<?php

namespace App\Filament\Resources\AssetResource\Pages;

use App\Filament\Resources\AssetResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateAsset extends CreateRecord
{
    protected static string $resource = AssetResource::class;

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            //->success()
            ->title('Sukses')
            ->body('Asset Berhasil Ditambahkan')
            ->actions([
                Actions\CloseAction::make(),
            ]);
    }
}
