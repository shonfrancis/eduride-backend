<?php

namespace App\Filament\Resources\StudentAds;

use App\Filament\Resources\StudentAds\Pages\CreateStudentAd;
use App\Filament\Resources\StudentAds\Pages\EditStudentAd;
use App\Filament\Resources\StudentAds\Pages\ListStudentAds;
use App\Filament\Resources\StudentAds\Schemas\StudentAdForm;
use App\Filament\Resources\StudentAds\Tables\StudentAdsTable;
use App\Models\Advertisement;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class StudentAdResource extends Resource
{
    protected static ?string $model = Advertisement::class;

    protected static ?string $navigationLabel = 'Student Requirement Ads';

    protected static ?string $modelLabel = 'Student Requirement Ad';

    protected static ?string $pluralModelLabel = 'Student Requirement Ads';

    protected static \UnitEnum|string|null $navigationGroup = 'Marketing';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('type', 'student_requirement');
    }

    public static function form(Schema $schema): Schema
    {
        return StudentAdForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StudentAdsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListStudentAds::route('/'),
            'create' => CreateStudentAd::route('/create'),
            'edit' => EditStudentAd::route('/{record}/edit'),
        ];
    }
}
