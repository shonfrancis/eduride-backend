<?php

namespace App\Filament\Resources\SeoSettings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SeoSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('page')
                    ->required(),
                TextInput::make('seo_title')
                    ->default(null),
                Textarea::make('meta_description')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('meta_keywords')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('canonical_url')
                    ->url()
                    ->default(null),
                TextInput::make('og_title')
                    ->default(null),
                Textarea::make('og_description')
                    ->default(null)
                    ->columnSpanFull(),
                FileUpload::make('og_image')
                    ->image(),
                TextInput::make('robots')
                    ->default(null),
            ]);
    }
}
