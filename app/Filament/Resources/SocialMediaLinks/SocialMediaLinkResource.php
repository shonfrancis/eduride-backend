<?php

namespace App\Filament\Resources\SocialMediaLinks;

use App\Filament\Resources\SocialMediaLinks\Pages\CreateSocialMediaLink;
use App\Filament\Resources\SocialMediaLinks\Pages\EditSocialMediaLink;
use App\Filament\Resources\SocialMediaLinks\Pages\ListSocialMediaLinks;
use App\Filament\Resources\SocialMediaLinks\Schemas\SocialMediaLinkForm;
use App\Filament\Resources\SocialMediaLinks\Tables\SocialMediaLinksTable;
use App\Models\SocialMediaLink;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SocialMediaLinkResource extends Resource
{
    protected static ?string $model = SocialMediaLink::class;

    protected static ?string $navigationLabel = 'Contact Info';

    protected static ?string $modelLabel = 'Contact Info';

    protected static ?string $pluralModelLabel = 'Contact Info';

    protected static \UnitEnum|string|null $navigationGroup = 'Settings';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhone;

    public static function canCreate(): bool
    {
        return SocialMediaLink::count() === 0;
    }

    public static function form(Schema $schema): Schema
    {
        return SocialMediaLinkForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SocialMediaLinksTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSocialMediaLinks::route('/'),
            'create' => CreateSocialMediaLink::route('/create'),
            'edit' => EditSocialMediaLink::route('/{record}/edit'),
        ];
    }
}
