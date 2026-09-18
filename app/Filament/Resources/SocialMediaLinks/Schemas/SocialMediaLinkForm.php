<?php

namespace App\Filament\Resources\SocialMediaLinks\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SocialMediaLinkForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Contact Details')
                    ->schema([
                        TextInput::make('phone')
                            ->label('Phone Number')
                            ->tel()
                            ->default(null),
                        TextInput::make('alt_phone')
                            ->label('Alt Phone Number')
                            ->tel()
                            ->default(null),
                        TextInput::make('whatsapp')
                            ->label('WhatsApp Number')
                            ->tel()
                            ->default(null),
                        TextInput::make('email')
                            ->label('Email Address')
                            ->email()
                            ->default(null),
                        TextInput::make('alt_email')
                            ->label('Alt Email Address')
                            ->email()
                            ->default(null),
                        Textarea::make('address')
                            ->label('Address')
                            ->default(null)
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Social Media Links')
                    ->schema([
                        TextInput::make('instagram')
                            ->label('Instagram URL')
                            ->url()
                            ->default(null),
                        TextInput::make('facebook')
                            ->label('Facebook URL')
                            ->url()
                            ->default(null),
                        TextInput::make('x')
                            ->label('X (Twitter) URL')
                            ->url()
                            ->default(null),
                        TextInput::make('linkedin')
                            ->label('LinkedIn URL')
                            ->url()
                            ->default(null),
                        TextInput::make('youtube')
                            ->label('YouTube URL')
                            ->url()
                            ->default(null),
                    ])->columns(2),

                Section::make('Status')
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->required(),
                    ]),
            ]);
    }
}
