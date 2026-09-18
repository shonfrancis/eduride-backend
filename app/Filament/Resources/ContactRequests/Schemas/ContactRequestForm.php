<?php

namespace App\Filament\Resources\ContactRequests\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ContactRequestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('requester_id')
                    ->required()
                    ->numeric(),
                TextInput::make('advertisement_id')
                    ->required()
                    ->numeric(),
                TextInput::make('owner_id')
                    ->required()
                    ->numeric(),
                Select::make('status')
                    ->options(['pending' => 'Pending', 'sent' => 'Sent'])
                    ->default('pending')
                    ->required(),
                DateTimePicker::make('sent_at'),
            ]);
    }
}
