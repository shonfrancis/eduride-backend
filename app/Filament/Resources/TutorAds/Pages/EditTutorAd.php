<?php

namespace App\Filament\Resources\TutorAds\Pages;

use App\Filament\Resources\TutorAds\TutorAdResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTutorAd extends EditRecord
{
    protected static string $resource = TutorAdResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
