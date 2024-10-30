<?php

namespace App\Filament\Resources\AssetResource\Pages;

use App\Filament\Resources\AssetResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateAsset extends CreateRecord
{
    protected static string $resource = AssetResource::class;

<<<<<<< HEAD
    public function save(): void
    {
        Notification::make()
            ->title('Saved successfully')
            ->success()
=======
    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Sukses')
            ->body('Asset Telah Ditambahkan')
>>>>>>> bc8ba68e58f533b1eca4eb76323b716188b23c10
            ->send();
    }
}
