<?php

namespace App\Filament\Resources\StudentAds\Tables;

use App\Mail\SendAdContactDetailsMail;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Mail;

class StudentAdsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('user.name')
                    ->label('Student / Parent')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('category.name')
                    ->label('Category')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('subject.name')
                    ->label('Subject')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('education_level')
                    ->label('Grade / Level')
                    ->searchable(),
                TextColumn::make('preferred_days')
                    ->label('Preferred Days')
                    ->badge()
                    ->separator(','),
                TextColumn::make('location.name')
                    ->label('Location')
                    ->searchable(),
                TextColumn::make('teaching_mode')
                    ->label('Preferred Mode')
                    ->formatStateUsing(fn (?string $state) => match ($state) {
                        'online' => 'Online',
                        'home_tuition' => 'Home Tuition',
                        'online_home' => 'Online & Home Tuition',
                        'centre' => 'Coaching Centre',
                        default => $state ?? 'N/A',
                    }),
                TextColumn::make('fee_min')
                    ->label('Min Budget (AED)')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('fee_max')
                    ->label('Max Budget (AED)')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge(),
                IconColumn::make('is_featured')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('sendContactDetails')
                    ->label('Send Contact Email')
                    ->icon(Heroicon::OutlinedEnvelope)
                    ->color('success')
                    ->form([
                        TextInput::make('recipient_email')
                            ->label('Recipient Email Address')
                            ->email()
                            ->required(),
                    ])
                    ->action(function ($record, array $data) {
                        Mail::to($data['recipient_email'])->send(new SendAdContactDetailsMail($record));

                        Notification::make()
                            ->title('Contact details sent successfully to ' . $data['recipient_email'])
                            ->success()
                            ->send();
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
