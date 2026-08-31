<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $navigationGroup = 'Boarding House Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->label('Booking Code')
                    ->required()
                    ->readOnly()
                    ->default(fn() => Transaction::generateUniqueCode())
                    ->placeholder('AUTO'),
                Forms\Components\Select::make('boarding_house_id')
                    ->label('Boarding House')
                    ->relationship('boardingHouse', 'name')
                    ->required(),
                Forms\Components\Select::make('room_id')
                    ->relationship('room', 'name')
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->placeholder('Type the name'),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->placeholder('Type the email address'),
                Forms\Components\TextInput::make('phone')
                    ->required()
                    ->placeholder('Type the phone number'),
                Forms\Components\Select::make('payment_method')
                    ->label('Payment Method')
                    ->options([
                        'down_payment' => 'Down Payment',
                        'full_payment' => 'Full Payment'
                    ])
                    ->required(),
                Forms\Components\TextInput::make('payment_status')
                    ->label('Payment Status')
                    ->required()
                    ->placeholder('Type the payment status'),
                Forms\Components\DatePicker::make('start_date')
                    ->label('Start Date')
                    ->required(),
                Forms\Components\TextInput::make('duration')
                    ->numeric()
                    ->minValue(1)
                    ->required()
                    ->placeholder('Type the duration in months'),
                Forms\Components\TextInput::make('total_amount')
                    ->label('Total Amount')
                    ->numeric()
                    ->prefix('IDR')
                    ->minValue(0)
                    ->required()
                    ->placeholder('Type the total amount'),
                Forms\Components\DatePicker::make('transaction_date')
                    ->label('Transaction Date')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code'),
                Tables\Columns\TextColumn::make('boardingHouse.name'),
                Tables\Columns\TextColumn::make('room.name'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('payment_method'),
                Tables\Columns\TextColumn::make('payment_status'),
                Tables\Columns\TextColumn::make('total_amount'),
                Tables\Columns\TextColumn::make('transaction_date'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}
