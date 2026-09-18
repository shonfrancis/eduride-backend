<?php

namespace App\Filament\Resources\TutorAds\Pages;

use App\Filament\Resources\TutorAds\TutorAdResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTutorAds extends ListRecords
{
    protected static string $resource = TutorAdResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
