<?php

namespace App\Filament\Resources\HomeBanners\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class HomeBannerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->default(null),
                TextInput::make('subtitle')
                    ->default(null),
                Textarea::make('description')
                    ->columnSpanFull()
                    ->default(null),
                FileUpload::make('image')
                    ->image()
                    ->hidden(),
                FileUpload::make('mobile_image')
                    ->image()
                    ->hidden(),
                TextInput::make('button_text')
                    ->default(null),
                TextInput::make('button_url')
                    ->url()
                    ->default(null),
                TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
