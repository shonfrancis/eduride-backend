<?php

namespace App\Filament\Resources\StudentAds\Schemas;

use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class StudentAdForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Basic Information')
                    ->schema([
                        TextInput::make('title')
                            ->label('Ad Title')
                            ->placeholder('e.g. Looking for Mathematics Tutor')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state ?? ''))),
                        TextInput::make('slug')->required(),
                        Hidden::make('type')->default('student_requirement'),
                        Select::make('user_id')
                            ->label('Student / Parent Name')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Textarea::make('description')
                            ->required()
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Student Requirement Details')
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
                            ->label('Grade / Education Level')
                            ->placeholder('e.g. Grade 9')
                            ->default(null),
                        Select::make('location_id')
                            ->label('Location')
                            ->relationship('location', 'name')
                            ->searchable()
                            ->preload()
                            ->default(null),
                        Select::make('teaching_mode')
                            ->label('Preferred Tuition Mode')
                            ->options([
                                'online' => 'Online',
                                'home_tuition' => 'Home Tuition',
                                'online_home' => 'Online & Home Tuition',
                                'centre' => 'Coaching Centre',
                            ])
                            ->default('home_tuition'),
                        TextInput::make('availability')
                            ->label('Time Availability')
                            ->placeholder('e.g. 5 PM - 7 PM')
                            ->default(null),
                        CheckboxList::make('preferred_days')
                            ->label('Preferred Days')
                            ->options([
                                'Monday' => 'Monday',
                                'Tuesday' => 'Tuesday',
                                'Wednesday' => 'Wednesday',
                                'Thursday' => 'Thursday',
                                'Friday' => 'Friday',
                                'Saturday' => 'Saturday',
                                'Sunday' => 'Sunday',
                            ])
                            ->columns(4)
                            ->columnSpanFull(),
                        TextInput::make('fee_min')
                            ->numeric()
                            ->label('Hourly Budget Min (AED)')
                            ->default(null),
                        TextInput::make('fee_max')
                            ->numeric()
                            ->label('Hourly Budget Max (AED)')
                            ->default(null),
                        TextInput::make('fee_type')
                            ->label('Budget Period')
                            ->default('per hour'),
                        Textarea::make('requirements')
                            ->label('Specific Requirements / Notes')
                            ->placeholder('e.g. Need experienced female tutor for Grade 9 CBSE Math')
                            ->default(null)
                            ->columnSpanFull(),
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
