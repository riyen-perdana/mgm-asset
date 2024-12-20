<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AssetResource\Pages;
use App\Filament\Resources\AssetResource\RelationManagers;
use App\Models\Asset;
use App\Models\Unit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Set;
use Filament\Support\Enums\Alignment;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\View\TablesRenderHook;
use Illuminate\Support\Str;
use stdClass;

class AssetResource extends Resource
{
    protected static ?string $model = Asset::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?string $navigationLabel = 'Manajemen Asset';

    protected static ?string $modelLabel = 'Manajemen Asset';

    protected static ?string $pluralModelLabel = 'Manajemen Asset';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->columns(2)
                    ->schema([
                        TextInput::make('asset_kd')
                            ->required()
                            ->unique('asset', 'asset_kd', ignoreRecord: true)
                            ->label('Kode Asset')
                            ->validationMessages([
                                'unique' => 'Kode Asset sudah ada, Isikan yang Lain',
                                'required' => 'Kolom Kode Asset Harus Diisi'
                            ]),
                        TextInput::make('asset_nm')
                            ->required()
                            ->label('Nama Asset')
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(Set $set, ?string $state) => $set('asset_slug', Str::slug($state)))
                            ->validationMessages([
                                'required' => 'Kolom Nama Asset Harus Diisi'
                            ]),
                        TextInput::make('asset_slug')
                            ->label('Slug')
                            ->required()
                            ->extraInputAttributes(['readonly' => true])
                            ->columnSpan(2)
                            ->validationMessages([
                                'required' => 'Kolom Nama Asset Harus Diisi'
                            ]),
                        Textarea::make('asset_almt')
                            ->label('Alamat Asset')
                            ->columnSpan(2)
                            ->required()
                            ->validationMessages([
                                'required' => 'Kolom Alamat Asset Harus Diisi'
                            ]),
                        Select::make('unit_id')
                            ->label('Unit')
                            ->options(Unit::all()->pluck('unit_nm', 'id'))
                            ->required()
                            ->searchable()
                            ->validationMessages([
                                'required' => 'Kolom Unit Harus Diisi'
                            ]),
                        TextInput::make('asset_jml')
                            ->label('Jumlah Asset')
                            ->required()
                            ->numeric()
                            ->validationMessages([
                                'required' => 'Kolom Jumlah Asset Harus Diisi',
                                'numeric' => 'Kolom Jumlah Asset Harus Angka'
                            ])
                    ])
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
                Tables\Columns\TextColumn::make('asset_kd')
                    ->label('Kode Asset')
                    ->width('15%')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('asset_nm')
                    ->label('Nama Asset')
                    ->sortable()
                    ->alignment(Alignment::Start)
                    ->searchable(),
                Tables\Columns\TextColumn::make('unit.unit_nm')
                    ->label('Unit')
                    ->alignment(Alignment::Start)
                    ->sortable(),
                Tables\Columns\TextColumn::make('asset_almt')
                    ->label('Alamat Asset')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('asset_jml')
                    ->label('Jumlah')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('unit_id')->label('Unit')->relationship('unit', 'unit_nm'),
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
