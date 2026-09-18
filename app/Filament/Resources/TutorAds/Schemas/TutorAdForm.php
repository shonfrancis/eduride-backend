<?php

namespace App\Filament\Resources\TutorAds\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class TutorAdForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Basic Information')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state ?? ''))),
                        TextInput::make('slug')->required(),
                        Select::make('type')
                            ->label('Ad Type')
                            ->options([
                                'tutor' => 'School / Medical Tutor',
                                'lsa' => 'Learning Support Assistant (LSA)',
                            ])
                            ->default('tutor')
                            ->required(),
                        Select::make('user_id')
                            ->label('Tutor / User')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Textarea::make('description')
                            ->required()
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Educational & Professional Details')
                    ->schema([
                        Select::make('category_id')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->default(null),
                        Select::make('subject_id')
                            ->relationship('subject', 'name')
                            ->searchable()
                            ->preload()
                            ->default(null),
                        TextInput::make('education_level')
                            ->label('Target Grade / Education Level')
                            ->placeholder('e.g. Grade 6-10 / Medical')
                            ->default(null),
                        TextInput::make('qualification')
                            ->label('Qualification')
                            ->placeholder('e.g. M.Sc Mathematics, B.Ed')
                            ->default(null),
                        TextInput::make('experience')
                            ->label('Teaching Experience')
                            ->placeholder('e.g. 5 years experience')
                            ->default(null),
                    ])->columns(2),

                Section::make('Location & Teaching Mode')
                    ->schema([
                        Select::make('location_id')
                            ->label('Location')
                            ->relationship('location', 'name')
                            ->searchable()
                            ->preload()
                            ->default(null),
                        Select::make('teaching_mode')
                            ->label('Teaching Mode')
                            ->options([
                                'online' => 'Online',
                                'home_tuition' => 'Home Tuition',
                                'online_home' => 'Online & Home Tuition',
                                'centre' => 'Coaching Centre',
                            ])
                            ->default('online_home'),
                        TextInput::make('availability')
                            ->label('Availability')
                            ->placeholder('e.g. Evening & Weekends')
                            ->default(null),
                        TextInput::make('fee_min')
                            ->numeric()
                            ->label('Hourly Fee Min (AED)')
                            ->default(null),
                        TextInput::make('fee_max')
                            ->numeric()
                            ->label('Hourly Fee Max (AED)')
                            ->default(null),
                        TextInput::make('fee_type')
                            ->label('Fee Period')
                            ->default('per hour'),
                    ])->columns(2),

                Section::make('Contact Details')
                    ->schema([
                        TextInput::make('contact_phone')
                            ->tel()
                            ->label('Contact Phone')
                            ->default(null),
                        TextInput::make('contact_email')
                            ->email()
                            ->label('Contact Email')
                            ->default(null),
                    ])->columns(2),

                Section::make('Media')
                    ->schema([
                        FileUpload::make('media')
                            ->multiple()
                            ->directory('advertisements')
                            ->default(null)
                            ->columnSpanFull(),
                    ]),

                Section::make('Publishing')
                    ->schema([
                        Select::make('status')
                            ->options([
                                'draft' => 'Draft',
                                'pending_review' => 'Pending review',
                                'approved' => 'Approved',
                                'rejected' => 'Rejected',
                                'published' => 'Published',
                                'suspended' => 'Suspended',
                                'expired' => 'Expired',
                            ])
                            ->default('published')
                            ->required(),
                        Toggle::make('is_featured')
                            ->default(false),
                        DateTimePicker::make('published_at'),
                        DateTimePicker::make('expires_at'),
                    ])->columns(2),
            ]);
    }
}
