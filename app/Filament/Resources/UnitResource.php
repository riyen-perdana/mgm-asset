<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UnitResource\Pages;
use App\Filament\Resources\UnitResource\RelationManagers;
use App\Models\Unit;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use stdClass;

class UnitResource extends Resource
{
    protected static ?string $model = Unit::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?string $navigationLabel = 'Unit';

    protected static ?string $pluralModelLabel = 'Unit';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('unit_kd')
                            ->required()
                            ->unique('unit', 'unit_kd', ignoreRecord: true)
                            ->label('Kode Unit')
                            ->validationMessages([
                                'unique' => 'Kode Sudah Ada, Isikan Yang Lain.',
                                'required' => 'Kolom Kode Unit Harus Diisi'
                            ]),
                        TextInput::make('unit_nm')
                            ->required()
                            ->label('Nama Unit')
                            ->validationMessages([
                                'required' => 'Kolom Nama Unit Harus Diisi'
                            ]),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('index')->state(
                    static function (HasTable $livewire, stdClass $rowLoop): string {
                        return (string) (
                            $rowLoop->iteration +
                            ($livewire->getTableRecordsPerPage() * (
                                $livewire->getTablePage() - 1
                            )).'.'
                        );
                    }
                )
                ->label('No.')
                ->width('3%'),
                Tables\Columns\TextColumn::make('unit_kd')
                    ->label('Kode Unit')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('unit_nm')
                    ->label('Nama Unit')
                    ->searchable()
                    ->sortable(),
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
            'index' => Pages\ListUnits::route('/'),
            // 'create' => Pages\CreateUnit::route('/create'),
            // 'edit' => Pages\EditUnit::route('/{record}/edit'),
        ];
    }
}
