<?php

namespace App\Filament\Resources;

use App\Enums\JenisKelamin;
use App\Enums\JenisRelasi;
use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Models\Client;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;
use stdClass;
use Filament\Tables\Columns\TextColumn;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?string $navigationLabel = 'Relasi';

    protected static ?string $modelLabel = 'Relasi';

    protected static ?string $pluralModelLabel = 'Relasi';

    protected static ?string $navigationIcon = 'heroicon-m-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    // ->columns(2)
                    ->schema([
                        Select::make('client_jns')
                            ->label('Jenis Relasi')
                            ->options(JenisRelasi::class)
                            ->searchable()
                            ->required()
                            ->validationMessages([
                                'required' => 'Kolom Jenis Relasi Harus Diisi'
                            ]),
                        TextInput::make('client_id')
                            ->required()
                            ->label('NIM, NIP atau Nomor KTP/Passport')
                            ->unique('client', 'client_id', ignoreRecord: true)
                            ->validationMessages([
                                'unique' => 'NIM, NIP atau Nomor KTP sudah ada, Isikan yang Lain',
                                'required' => 'Kolom NIM, NIP atau Nomor KTP Harus Diisi'
                            ]),
                        TextInput::make('client_nm')
                            ->required()
                            ->label('Nama')
                            ->validationMessages([
                                'required' => 'Kolom Nama Harus Diisi'
                            ])
                            ->placeholder('Jenis Pengguna'),
                        Select::make('client_jk')
                            ->label('Jenis Kelamin')
                            ->options(JenisKelamin::class)
                            ->searchable()
                            ->required()
                            ->validationMessages([
                                'required' => 'Kolom Jenis Kelamin Harus Diisi'
                            ]),
                        Textarea::make('client_alamat')
                            ->required()
                            ->label('Alamat')
                            ->validationMessages([
                                'required' => 'Kolom Alamat Harus Diisi'
                            ])
                            ->columnSpan(2),
                        TextInput::make('client_email')
                            ->email()
                            ->required()
                            ->label('Email')
                            ->validationMessages([
                                'required' => 'Kolom Email Harus Diisi',
                                'email' => 'Kolom Email Tidak Valid'
                            ]),
                        TextInput::make('client_telp')
                            ->tel()
                            ->required()
                            ->label('Nomor Telepon')
                            ->validationMessages([
                                'required' => 'Kolom Nomor Telepon Harus Diisi',
                                'tel' => 'Kolom Nomor Telepon Tidak Valid'
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
                Tables\Columns\TextColumn::make('client_id')
                    ->label('No. Pengenal')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('client_nm')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('client_jk')
                    ->label('Jenis Kelamin')
                    ->searchable()
                    ->width('15%')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('client_alamat')
                    ->label('Alamat')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('client_email')
                    ->label('Email')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('client_telp')
                    ->label('Nomor Telepon')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('client_jns')
                    ->label('Jenis Relasi')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(fn ($state) => $state->getColor()),
            ])
            ->filters([
                SelectFilter::make('client_jns')
                    ->label('Jenis Relasi')
                    ->options(JenisRelasi::class),
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
            'index' => Pages\ListClients::route('/'),
            // 'create' => Pages\CreateClient::route('/create'),
            // 'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
