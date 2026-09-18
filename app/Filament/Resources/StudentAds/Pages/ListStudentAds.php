<?php

namespace App\Filament\Resources\StudentAds\Pages;

use App\Filament\Resources\StudentAds\StudentAdResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListStudentAds extends ListRecords
{
    protected static string $resource = StudentAdResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
