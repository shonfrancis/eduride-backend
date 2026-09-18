<?php

namespace App\Filament\Resources\TutorAds;

use App\Filament\Resources\TutorAds\Pages\CreateTutorAd;
use App\Filament\Resources\TutorAds\Pages\EditTutorAd;
use App\Filament\Resources\TutorAds\Pages\ListTutorAds;
use App\Filament\Resources\TutorAds\Schemas\TutorAdForm;
use App\Filament\Resources\TutorAds\Tables\TutorAdsTable;
use App\Models\Advertisement;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TutorAdResource extends Resource
{
    protected static ?string $model = Advertisement::class;

    protected static ?string $navigationLabel = 'Tutor & LSA Ads';

    protected static ?string $modelLabel = 'Tutor Ad';

    protected static ?string $pluralModelLabel = 'Tutor & LSA Ads';

    protected static \UnitEnum|string|null $navigationGroup = 'Marketing';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAcademicCap;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereIn('type', ['tutor', 'lsa']);
    }

    public static function form(Schema $schema): Schema
    {
        return TutorAdForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TutorAdsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTutorAds::route('/'),
            'create' => CreateTutorAd::route('/create'),
            'edit' => EditTutorAd::route('/{record}/edit'),
        ];
    }
}
