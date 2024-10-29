<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AssetResource\Pages;
use App\Filament\Resources\AssetResource\RelationManagers;
use App\Models\Asset;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Set;
use Filament\Support\Enums\Alignment;
use Filament\Tables\View\TablesRenderHook;
use Illuminate\Support\Str;


class AssetResource extends Resource
{
    protected static ?string $model = Asset::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->columns(2)
                    ->schema([
                        TextInput::make('asset_kd')
                            ->required()
                            ->unique('asset', 'asset_kd',ignoreRecord: true)
                            ->label('Kode Asset'),
                        TextInput::make('asset_nm')
                            ->required()
                            ->label('Nama Asset')
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('asset_slug', Str::slug($state))),
                        TextInput::make('asset_slug')
                            ->label('Slug')
                            ->required()
                            ->extraInputAttributes(['readonly' => true])
                            ->columnSpan(2)
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('asset_kd')->label('Kode Asset')->width('15%')->searchable()->toggleable()->alignment(Alignment::Start),
                Tables\Columns\TextColumn::make('asset_nm')->label('Nama Asset')->grow(true)->searchable()->toggleable(),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListAssets::route('/'),
            // 'create' => Pages\CreateAsset::route('/create'),
            // 'edit' => Pages\EditAsset::route('/{record}/edit'),
        ];
    }
}
