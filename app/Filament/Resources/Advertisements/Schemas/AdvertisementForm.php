<?php

namespace App\Filament\Resources\Advertisements\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class AdvertisementForm
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
                            ->options(['tutor' => 'Tutor', 'lsa' => 'LSA', 'student_requirement' => 'Student requirement'])
                            ->required()
                            ->live(), // To trigger conditional fields
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->required(),
                        Textarea::make('description')
                            ->required()
                            ->columnSpanFull(),
                    ]),

                Section::make('Educational Information')
                    ->schema([
                        Select::make('category_id')
                            ->relationship('category', 'name')
                            ->default(null),
                        Select::make('subject_id')
                            ->relationship('subject', 'name')
                            ->default(null),
                        TextInput::make('education_level')
                            ->default(null),
                        TextInput::make('qualification')
                            ->default(null)
                            ->visible(fn (Get $get) => in_array($get('type'), ['tutor', 'lsa'])),
                        TextInput::make('experience')
                            ->default(null)
                            ->visible(fn (Get $get) => in_array($get('type'), ['tutor', 'lsa'])),
                    ]),

                Section::make('Location')
                    ->schema([
                        TextInput::make('country')->default(null),
                        TextInput::make('state')->default(null),
                        TextInput::make('city')->default(null),
                        TextInput::make('area')->default(null),
                        Textarea::make('address')->default(null)->columnSpanFull(),
                    ])->columns(2),

                Section::make('Teaching / Requirement Details')
                    ->schema([
                        TextInput::make('teaching_mode')
                            ->default(null),
                        TextInput::make('availability')
                            ->default(null),
                        TextInput::make('fee_min')
                            ->numeric()
                            ->default(null)
                            ->label(fn (Get $get) => $get('type') === 'student_requirement' ? 'Budget Min' : 'Fee Min'),
                        TextInput::make('fee_max')
                            ->numeric()
                            ->default(null)
                            ->label(fn (Get $get) => $get('type') === 'student_requirement' ? 'Budget Max' : 'Fee Max'),
                        TextInput::make('fee_type')
                            ->default(null),
                        Textarea::make('requirements')
                            ->default(null)
                            ->visible(fn (Get $get) => $get('type') === 'student_requirement')
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Contact')
                    ->schema([
                        TextInput::make('contact_phone')
                            ->tel()
                            ->default(null),
                        TextInput::make('contact_email')
                            ->email()
                            ->default(null),
                    ])->columns(2),

                Section::make('Media')
                    ->schema([
                        FileUpload::make('media')
                            ->multiple()
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
                            ->default('draft')
                            ->required(),
                        Toggle::make('is_featured')
                            ->required(),
                        Textarea::make('rejection_reason')
                            ->default(null)
                            ->visible(fn (Get $get) => $get('status') === 'rejected')
                            ->columnSpanFull(),
                        DateTimePicker::make('published_at'),
                        DateTimePicker::make('expires_at'),
                    ])->columns(2),
            ]);
    }
}
