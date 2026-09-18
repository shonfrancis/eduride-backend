<?php

namespace App\Filament\Resources\StudentAds\Pages;

use App\Filament\Resources\StudentAds\StudentAdResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditStudentAd extends EditRecord
{
    protected static string $resource = StudentAdResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
